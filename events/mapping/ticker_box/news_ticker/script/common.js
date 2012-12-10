$(function()
{
	var ticker = function()
	{
		/*
		var current = -1;
			var elems = new Array();
			var elems_i = 0;
			$('.items').each(function() {
				elems[elems_i++] = $(this);
			});
			var num_elems = elems_i - 1;
			var animate_out = function() {
				elems[current].animate({ top: '-100px' }, 'fast', 'linear', animate_in);
			}
			var animate_out_delay = function() {
				setTimeout(animate_out, 1000); 
			}
			var animate_in = function() {
				current = current < num_elems ? current + 1 : 0;
				elems[current].css('top', '200px').animate({ top: '0px' }, 'fast', 'linear', animate_out_delay);
			}
			animate_in();

		

*/
		setTimeout(function(){
			$('#ticker li:first').animate( {marginTop: '-120px'}, 800, function()
			{
				$(this).detach().appendTo('ul#ticker').removeAttr('style');	
			});
			ticker();
		}, 4000);
	};
	ticker(); 
});