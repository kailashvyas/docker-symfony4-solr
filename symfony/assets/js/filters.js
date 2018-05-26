// assets/js/greet.js
module.exports = function() {
	$('.filters ul')
	  .find('li:gt(3)')
	  .hide()
	  .end()
	  .append(
	    $('<li>Show More...</li>').click( function(){
	      $(this).siblings(':hidden').show().end().remove();
	    })
	);
};