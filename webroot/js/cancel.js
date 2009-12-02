var webroot = '/cake/madeleine';
var action = 'cancel';
var className = 'madeleine-cancel';

var load = function(src, check, next) {
	check = new Function('return !!(' + check + ')');
	if (!check()) {
		var script = document.createElement('script')
		script.src = src;
		document.body.appendChild(script);
		setTimeout(function() {
			if (!check()) setTimeout(arguments.callee, 100);
			else next();
		}, 100);
	}
	else next();
};

document.open();
document.write('<div class="' + className + '"></div>');
document.close();

load(
	webroot + '/jquery/js/jquery-1.3.2.min.js', 
	'window.jQuery', 
	function() {
		$.getScript(webroot + '/jquery/js/jquery.form.js', function() {});
		$.get(webroot + '/users/' + action, function(html) {
			$('div.' + className).replaceWith(html);
		});
	}
);
