var LM = {

	/************** TOOL FUNCTION ********************/

	/* AJOUT CLASS LAST DERNIER LI et ID sur le body POUR DESCENDANCE RESET CSS*/

	reseTool:function(){
		jQuery('ul li:last-child').addClass('last');
		jQuery('body').attr('id','page')
	},
	
	delayedsrc:function(){
		jQuery(document).ready(function() {
			$('img').each(function(){
			  	$(this).attr('src', $(this).attr('delayedsrc'));
			});
		});
	},	
	
	obfuscateLink:function(){
		jQuery('.hiddenLink').each(function(index, span) {
	        $(span).removeClass('hiddenLink');

	        var base16  = "0A12B34C56D78E9F";
	        var link    = document.createElement('a');
	        var styles  = span.className.split(' ');
	        var encoded = styles[0];
	        var decoded = '';

	        // Decoding href. Source : @position
	        for (var i = 0; i < encoded.length; i += 2) {
	            var ch = base16.indexOf(encoded.charAt(i));
	            var cl = base16.indexOf(encoded.charAt(i+1));
	            decoded += String.fromCharCode((ch*16)+cl);
	        }

	        styles.shift();
	        link.className  = styles.join(' ');
	        link.href       = decoded;
	        link.target     = '_blank';
	        link.innerHTML  = span.innerHTML;

	        $(span).replaceWith(link);
	    });
	},	

	checkForm: function(){

		jQuery('input:not(input[type="submit"]), textarea').each(function(){

			if (jQuery(this).attr('data-validate')) {

				defaultValue = jQuery(this).attr('data-validate');

				jQuery(this).val(defaultValue)

			};
		
		})

 		$('textarea[maxlength]').keypress(function(){  
			  
		    var limit = parseInt($(this).attr('maxlength'));  
		    var text = $(this).val();  
		    var nbChar = text.length;  

		    if(nbChar > limit){  
			      
		        var defaultText = text.substr(0, limit);  

		        $(this).val(defaultText);  
		    }  
		});  


		var emailReg = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;

		var postCode = /^((0[1-9])|([1-8][0-9])|(9[0-8])|(2A)|(2B))[0-9]{3}$/;

		var phone = /^0[1-6]{1}(([0-9]{2}){4})|((\s[0-9]{2}){4})|((-[0-9]{2}){4})$/;


 		jQuery('form').each(function(){

 			jQuery(this).live('submit', function(e){

			/* reset des class error pour que les champs caché ne conserve pas la classe si on 
			décide de finalament les masqué*/
				
				jQuery('input, select, textarea', this).removeClass('error')
				
				/* INPUT TEXT */

				jQuery('input.required.text:visible',this).each(function(){

					if(jQuery(this).val() == jQuery(this).attr('data-validate') || jQuery(this).val() == ''){
						jQuery(this).addClass('error')

					}else{
						jQuery(this).removeClass('error')
					}
				})

				jQuery('textarea.required:visible', this).each(function(){

					if(jQuery(this).val() == jQuery(this).attr('data-validate') || jQuery(this).val() == ''){
						jQuery(this).addClass('error')

					}else{
						jQuery(this).removeClass('error')
					}
				})

				/* INPUT TEXT EMAIL */

				jQuery('input.required.email:visible', this).each(function(){
					
					 if(!emailReg.test(jQuery(this).val()) || jQuery(this).val() == ''){
						jQuery(this).addClass('error')
					
					}else{
						jQuery(this).removeClass('error')
					}
				})

				/* INPUT TEXT TELEPHONE */

				jQuery('input.required.phone:visible', this).each(function(){

					 if(!phone.test(jQuery(this).val()) || jQuery(this).val() == ''){
						jQuery(this).addClass('error')
					
					}else{
						jQuery(this).removeClass('error')
					}
				})

				/* VERIF DU CHAMPS TEL, qui n'est pas obligatoire mais a partir du moment ou il est rempli il doit etre au bon foramt */
				jQuery('input.phoneField:visible', this).each(function(){

					if(phone.test(jQuery(this).val()) || jQuery(this).val() == jQuery(this).attr('data-validate')){
					
						jQuery(this).removeClass('error')
						
					}else{
						jQuery(this).addClass('error')
		
					}
				})

				jQuery('input.required.fax:visible', this).each(function(){

					 if(!phone.test(jQuery(this).val())){
						jQuery(this).addClass('error')
					
					}else{
						jQuery(this).removeClass('error')
					}
				})
				/* INPUT TEXT CODE POSTAL */

				jQuery('input.required.postCode:visible', this).each(function(){

					 if(!postCode.test(jQuery(this).val())){
						jQuery(this).addClass('error')
					
					}else{
						jQuery(this).removeClass('error')
					}
				})

				/* SELECT */

				jQuery('select.required:visible', this).each(function(){

				if(jQuery('option:selected', this).val() == 0){
						jQuery(this).addClass('error')

					}else{
						jQuery(this).removeClass('error')
					}
				})

				/*RADIO */

				jQuery('.radioGroup', this).each(function(){
					that = this;

					if(jQuery('input[type="radio"].required:checked', this).length){
						jQuery('label',this).removeClass('error')

					}else{
						jQuery('label',this).addClass('error')

					}

				})

				
				/*CHECKBOX */

				jQuery('input[type="checkbox"].required:visible', this).each(function(){

				if(jQuery(this).is(':checked')){
				
						jQuery(this).siblings('label').removeClass('error')

					}else{
						jQuery(this).siblings('label').addClass('error')
						
					}
				})

				/* GESTION DES ERREURS */


				if(jQuery('.error', this).length){

					jQuery('.error-message', this).remove()
	
					if(jQuery('input.text.error', this).length || jQuery('select.error').length || jQuery('.radioLabel.error').length || jQuery('.checkboxLabel.error').length){
						jQuery(this).prepend('<p class="error-message">Les champs marqués (*) sont obligatoires</p>')
					}

					if(jQuery('input.email.error', this).length){
						jQuery(this).prepend("<p class='error-message'>L'email doit avoir un format correct</p>")
					}

					if(jQuery('input.postCode.error', this).length){
						jQuery(this).prepend("<p class='error-message'>Le code postal doit avoir un format correct</p>")
					}

					if(jQuery('input.phone.error', this).length){
						jQuery(this).prepend("<p class='error-message'>Le téléphone doit avoir un format correct</p>")
					}

					if(jQuery('input.phone.fax', this).length){
						jQuery(this).prepend("<p class='error-message'>Le fax doit avoir un format correct</p>")
					}

					e.preventDefault()

				}else{
					//SBLA RESET CHAMPS NON OBLIGATOIRE AVEC DATA-VALIDATE
					jQuery("input[data-validate]:not('.required')",this).each(function(){
						if( jQuery(this).val() == jQuery(this).attr('data-validate') ) {
							jQuery(this).val('');
						}
					});
				}

			})

 		})

	},

	init: function(){
		// console.log('JQUERY VERSION', $.fn.jquery, 'FLEXSLIDER PLUGGIN ?', $.fn.flexslider);
		LM.reseTool()
		LM.checkForm()
		LM.obfuscateLink()
		LM.delayedsrc()
	}
}

jQuery(document).ready(function(){
	LM.init();
});