var cookies = (function () {
	var arr = document.cookie.split(/\s*;\s*/),
		cookies = {},
		pair;

	for (var i = 0; i < arr.length ;++i) {
		pair = arr[i].split(/\s*=\s*/);
		cookies[pair[0]] = pair[1];
	}
	return cookies;
})();

function slugify (text) {
    'use strict';
    if(typeof(text) == 'undefined') { return ''; }
    text = text.trim().toLowerCase();
    text = text.replace(/[&,]/gi, '');
    text = text.replace(/[éèêë]/gi, 'e');
    text = text.replace(/[àâä]/gi, 'a');
    text = text.replace(/[ù]/gi, 'u');
    text = text.replace(/[î]/gi, 'i');
    text = text.replace(/[ô]/gi, 'o');
    text = text.replace(/[- "']/gi, "_");
    return text;
}

//parseUri 1.2.2
//(c) Steven Levithan <stevenlevithan.com>
//MIT License
function parseUri (str) {
	'use strict';
	var	o   = parseUri.options,
		m   = o.parser[o.strictMode ? "strict" : "loose"].exec(str),
		uri = {},
		i   = 14;

	while (i--) { uri[o.key[i]] = m[i] || ""; }

	uri[o.q.name] = {};
	uri[o.key[12]].replace(o.q.parser, function ($0, $1, $2) {
		if ($1) { uri[o.q.name][$1] = $2; }
	});

	return uri;
}
parseUri.options = {
		strictMode: false,
		key: ["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],
		q:   {
			name:   "queryKey",
			parser: /(?:^|&)([^&=]*)=?([^&]*)/g
		},
		parser: {
			strict: /^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,
			loose:  /^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/
		}
	};


//String prototype
String.prototype.stripAccents = function() {
	'use strict';
    var translate_re = /[àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ&]/g,
    	translate = 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYe';

    return (this.replace(translate_re, function(match){
        return translate.substr(translate_re.source.indexOf(match)-1, 1); })
    );
};
String.prototype.trim = function() {
	'use strict';
	return this.replace(/^\s+|\s+$/g, '');
};


//Recherche val ds tableau
function searchInTab(value, tab) {
	'use strict';
	var found = false;
	$.each(tab, function(index, item) {
		if(item.toLowerCase() == value.toLowerCase()) {
			found = true;
		}
	});
	return found;
}
