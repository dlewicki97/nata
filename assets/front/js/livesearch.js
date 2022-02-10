(function(){
	var inputFilter = document.querySelector("[data-filter]");
  	inputFilter.addEventListener("keyup", function(){
	  	if(inputFilter.value == '') {
	  		document.getElementById('productsSearch').style.display = 'none';
	  	} else {
	  		document.getElementById('productsSearch').style.display = 'block';
	  	}
	  	var inputValue = this.value, i;
	    var filterList = document.getElementById(this.dataset.filter);
	    var filterItem = filterList.querySelectorAll("li");
	    for (i = 0; i < filterItem.length; i++) {
	    	var _this = filterItem[i];
	        var phrase = _this.innerHTML; 
	    	if (phrase.search(new RegExp(inputValue, "i")) < 0) {
	      	_this.style.display = "none";
	      } else {
	      	_this.style.display = "block";
	      }
	    }
  });
})();