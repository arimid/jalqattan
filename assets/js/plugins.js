/*global $, jquery, alert ,console ,scrollY*/
var datee = document.getElementById('date'),
	hDate;

	
datee.innerHTML = hDate;


    
function readURL(input) {
	"use strict";
	if (input.files && input.files[0]) {
            
		var reader = new FileReader();
            
            
		reader.onload = function (e) {
                
			$('#blah').attr('src', e.target.result);
            
		};
            
            
		reader.readAsDataURL(input.files[0]);
        
	}
    
}
    

$("#imgInp").change(function () {
	"use strict";
	readURL(this);
    
});
