function slugify (text) {
    if(typeof(text) == 'undefined') { return ''; }
    text = text.trim();
    text = text.replace(/[éèêë]/gi, 'e');
    text = text.replace(/[àâä]/gi, 'a');
    text = text.replace(/[ù]/gi, 'u');
    text = text.replace(/[ô]/gi, 'o');
    text = text.replace(/[- ]/gi, "_");
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

function stripAccents(str) {
    var translate_re = /[àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ&]/g;
    var translate = 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUYe';
    return (str.replace(translate_re, function(match){
        return translate.substr(translate_re.source.indexOf(match)-1, 1); })
    );
};
