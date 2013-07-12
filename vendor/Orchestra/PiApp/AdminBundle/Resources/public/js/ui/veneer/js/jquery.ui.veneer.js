/*
 * jQuery UI Veneer @VERSION

 *
 * Copyright (c) 2010 Steven Black (http://stevenblack.com/)
 * Dual licensed under the MIT (MIT-LICENSE.txt)
 * and GPL (GPL-LICENSE.txt) licenses.
 *
 * http://docs.jquery.com/UI/Veneer
 *
 * Depends:
 *	jquery.ui.core.js
 *	jquery.ui.widget.js
 */
(function( $ ) {
	
	$.extend( $.expr[ ':' ], {
		// selects all the headers below the passed index.  So 2 matches <h3>, <h4>, <h5>.
		headerBelow: function( elem, i, match ) { 
			if ( /h\d/i.test( elem.nodeName ) )  {
				var level= parseInt( match[ 3 ], 10 ) + 1,  str = "h["+ level +"-5]", re = new RegExp( str, "i" ), ret ;
				return re.test( elem.nodeName ); 
			}
			return false;
		},
		// selects all the headers above the passed index.  So 3 matches <h1> and <h2>.
		headerAbove: function( elem, i, match ) { 
			if ( /h\d/i.test( elem.nodeName ) )  {		
				var level= ( parseInt( match [ 3 ], 10 ) - 1 ) || 1, str = "h[1-"+ level +"]", re = new RegExp( str, "i" ) ;
				return re.test( elem.nodeName ); 
			}
			return false;
		}
	});
	
	$.widget( "ui.veneer", {
		options: {
			// Keep the standard jQuery-ui border
			uiBorder : true,
			// Is the veneered container initially collapsed
			collapsed: false,
			// Is the veneered container collapsible
			collapsible: false,
			// Collapse speed, if the veneered container is, in fact, collapsible			
			collapseSpeed: 500,
			// array of headers to auto-veneer.  Example { headers: ["h2", "h3"]}
			headers: [],
			icons: {
				collapsed: "ui-icon-triangle-1-e",
				open: "ui-icon-triangle-1-s"
			},
			// Classes to add to the default classes
			instanceClasses: {
				content: "", 
				title: "",
				header: "",
			},
			classes : {
				// All the classes this widget potentially adorns on elements.  This element is used only
				// for tear-down purposes.  All these classes will be removed from veneered elements.			
				veneer:	"ui-veneer ui-veneer-content ui-veneer-header ui-widget " +
					"ui-widget-content ui-state-default ui-corner-all ui-veneer-clickable " +
					"ui-veneer-noUiBorder ui-helper-reset",
				// These are the classes this widget adorns on widgets				
				widget: "ui-veneer ui-widget ui-widget-content",
				// These classes are content adornments
				content:  "ui-veneer-content",
				// These classes are titke adornments
				title: "ui-veneer-header ui-veneer-title ui-state-default ui-helper-reset",
				// Header adornments
				header: "ui-veneer-header ui-state-default"
			},				
			roundCorners: true,
			// Title to add to the veneered container -- applies only to non-header based containers
			title: "",
			titleAttr: false,
				
			// Create header-based containers
			headersHierarchy: true
		},

    // _create is called on construction
		_create: function() {
			var self = this, 
				o = self.options,
				classes= o.classes,
				instanceClasses= o.instanceClasses,
				title = o.title || ( o.titleAttr ? this.element.attr( 'title' ) : "" ),

				// collection of elements created or modified by this widget, used for auto-destroy algorithm.
				touched= ( o._touched = { newElement: [], newWrapper: [], adorned: [] } ) , 
				
				// Are we dealing with a container or with a header/hierarchy?
				selfIsHeader = self.element.is( ":header" ), selfHeaderLevel;

			selfHeaderLevel = selfIsHeader ? parseInt( self.element[0].nodeName.substring(1), 10 ) : 0 ;

			var uiVeneer = ( self.uiVeneer = this );			

			// resolve some of the cosmetics right now.  Round-corners are optional.
			if ( o.roundCorners ) {
				classes.widget	+= " ui-corner-all";
				classes.header	+= " ui-corner-all";
				classes.title		+= " ui-corner-all";
				classes.content	+= " ui-corner-all";
			}
		
			var veneerContentWrapper = $( "<div />" ).addClass( ( classes.content+ " "+ instanceClasses.content ).trim() );
		
			// resolve whether we wrap the self and subsequent hierarchy
			if ( o.headersHierarchy && selfIsHeader && selfHeaderLevel ) {

				var self= this, 
					o= self.options,
					classes= o.classes,
					instanceClasses= o.instanceClasses;

				//  ===== We're veneering based on a header! =====
				var veneerWrapper = $( "<div />" ).addClass( ( classes.widget+ " "+ instanceClasses.widget ).trim() )
					lowerLevelMax = ( selfHeaderLevel + 1 ) || 1;
				
				if ( ! o.uiBorder ) {
					veneerWrapper.addClass( "ui-veneer-noUiBorder" );
				}
			
				// Make sure the header has its text in a child element, i.e. not just text
				if ( o.collapsible && self.element.children().length === 0 ) {
					self.element.addClass( "ui-veneer-clickable" )
					self.element.wrapInner( '<a href="#" />' );
					touched.newWrapper.push( self.element.children().eq(0) );				
				}
				
				self.element.addClass( ( classes.header+ " "+  instanceClasses.header ).trim() );
				touched.adorned.push( self.element );
							
				// If collapsible, wire-in the hide/show behaviour
				if ( o.collapsible ) { 
					// the icon
					$("<span/>").addClass( "ui-icon " + o.icons.open ).prependTo( self.element ); 
					touched.newElement.push( self.element.find("span.ui-icon") );				

					// handling the click
					self.element.bind( "click.veneer", function(event, data) {
						self._clickHandler.call(self, event, this, data );
						event.preventDefault();
					});
				}

				var siblingsToWrap= this.element.nextUntil( ":headerAbove(" + lowerLevelMax + ")" );
				siblingsToWrap.wrapAll( veneerContentWrapper );
				touched.newWrapper.push( siblingsToWrap.eq( 0 ).parent() );
	
				var batchToWrap= this.element.nextUntil( ":headerAbove(" + lowerLevelMax + ")" ).andSelf();
				batchToWrap.wrapAll( veneerWrapper );
				touched.newWrapper.push( batchToWrap.eq( 0 ).parent() );	
				
				// Collapse if so configured
				if ( o.collapsible && o.collapsed ) {
					// No animation here
					self.element.trigger( "click.veneer", [ { collapseSpeed: 0 } ] )
				}

			}
			else
			{
				// container, possibly with a title attribute
				var selfElementChildren= self.element.children().detach();
				self.element.addClass( ( classes.widget + " " + instanceClasses.widget ).trim() );
				if ( ! o.uiBorder ) { self.element.addClass( "ui-veneer-noUiBorder" ); }
				touched.adorned.push( self.element );
	
				if ( title ) { self._createTitleBar( title ); }
			
				veneerContentWrapper.append( selfElementChildren );
				self.element.append( veneerContentWrapper );        
				touched.newWrapper.push( veneerContentWrapper );			
		
				// processing for headers within the veneer
				if ( o.headers[0] ) {
					var headingSelector = o.headers.join(",");
					self.element.find(  headingSelector ).each( function() {
						var heading = $( this );
						heading.veneer( o );
						touched.adorned.push( heading );
					});
				}
			}
		},
	
		// _init is called both on construction and for re-initializing the function 
		_init: function() { },
	

		destroy: function() {
			var o= this.options, 
					el= this.element, 
					touched= o._touched;

			// Note that the elements in the arrays within touched are pre-wrapped with jQuery.
			// Remove any flat-out newElement elements
			while ( touched.newElement.length ) { 
				touched.newElement.pop().remove(); }

			// Remove the adornments on pre-existing elements including this one
			while ( touched.adorned.length ) { 
				touched.adorned.pop().removeClass( o.classes.veneer ); }
			
			// Remove the wrappers
			while ( touched.newWrapper.length ) { 
				var wrap= touched.newWrapper.pop();
				wrap.replaceWith( wrap[0].childNodes );
			}
			el.unbind('.veneer').removeClass( o.classes.veneer ).removeData( "veneer" );
		
			$.Widget.prototype.destroy.call( this );
		
		},
	
		_clickHandler: function(event, target, instanceOptions) {
			var o = $.extend( {}, this.options, instanceOptions), icons = o.icons;
			if  (o.disabled || ( ! o.collapsible ) ) { return; }
			var target= $(event.currentTarget);
			target.next().slideToggle( o.collapseSpeed );
			target.children(".ui-icon").toggleClass( icons.collapsed ).toggleClass( icons.open );
		},
	
		_setOption: function(key, value){
			$.Widget.prototype._setOption.apply(this, arguments);
		
			var self = this,
				uiVeneer = self.uiVeneer.element;

			if ( key === "title" ) {   
				self._createTitleBar( value );
			}
		
			if ( key === "uiBorder" ) {   
				if ( value ) {
					uiVeneer.removeClass( "ui-veneer-noUiBorder" );
				}
				else
				{
					uiVeneer.addClass( "ui-veneer-noUiBorder" );				
				}
			}		

			$.Widget.prototype._setOption.apply( self, arguments );
		},
	
		_createTitleBar: function( title ) {

			var self= this, hasTitleBar= !! self.uiVeneerTitlebar;
				
			if ( ! hasTitleBar ) {
				// build-it
				var o = this.options,
					classes = o.classes,
					instanceClasses= o.instanceClasses,
					titleId = $.ui.veneer.getTitleId( self.element ),
					uiVeneerTitlebar = ( self.uiVeneerTitlebar = $('<div></div>') )
							.addClass( ( classes.title + " " + instanceClasses.title ).trim() );
		 
					self.uiVeneerTitle = $( '<span></span>' )
						.addClass( 'ui-dialog-title' )
						.attr( 'id', titleId )
						.prependTo( uiVeneerTitlebar );
					
						uiVeneerTitlebar.prependTo( self.element );
						o._touched.newElement.push( uiVeneerTitlebar );				
				}
				
				// set the title
				title=  title || '&#160;';
				self.uiVeneerTitle.html( title );
				self.uiVeneerTitlebar.show();
		},
		
		showTitle: function( lShow ) {
			// Serves to both show and hide any veneer title
			if ( typeof( lShow )==="undefined" ) { lShow= true; }
			var self= this;
			if ( self.uiVeneerTitlebar ) {
				if ( lShow ) { self.uiVeneerTitlebar.show(); }
				else  { self.uiVeneerTitlebar.hide(); } 
			}
		},
		
		collapse: function ( lHide, options ) {
			// Serves to both collapse amd uncollapse a veneered container
			if ( typeof( lHide )=== "object" ) {
				options= lHide;
				delete lHide;
			}
			var self= this, o= $.extend( {}, self.options, options );
			if ( ! o.collapsible ) { return; }			
			var next= self.element.next(), nextVis= next.is( ":visible" );
			if ( typeof( lHide )==="undefined" ) { lHide= true; }
			if ( ( lHide && nextVis ) || ( ( ! lHide ) && ( ! nextVis ) ) ) {
				self.element.trigger( "click.veneer", [ o ]);
			}
		}

	});
	
})(jQuery);

$.extend($.ui.veneer, {
	version: "@VERSION",

	uuid: 0,

	getTitleId: function($el) {
		return 'ui-dialog-title-' + ($el.attr('id') || ++this.uuid);
	}
});