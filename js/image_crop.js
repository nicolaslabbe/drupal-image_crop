var image_crop = {
		
		init: function ()
		{
			'use strict';
			
			image_crop.bindEvents();
			
			var checked = document.querySelector('.imagePositionWidget .form-item input[type="radio"][checked="checked"');
			if(checked !== null && typeof checked === 'object') {
				checked.parentNode.className = checked.parentNode.className + ' active';
			}
		},
		
		bindEvents: function ()
		{
			'use strict';
			
			var items = document.querySelectorAll('.imagePositionWidget .form-item');
			
			if(items.length > 0) {
			
				for(var i in items) {
					if(typeof items[i] === 'object') {
						items[i].addEventListener('click', function (e)
						{
								var other_items = document.querySelectorAll('.imagePositionWidget .form-item');
								
							for(var j in other_items) {
								if(typeof items[j] === 'object') {
									other_items[j].className = other_items[j].className.replace(/ active/);
								}
							}
							
							this.className = this.className + ' active';
						});
					}
				}
			}
		}
};

window.addEventListener('load', function ()
{
	image_crop.init();
});