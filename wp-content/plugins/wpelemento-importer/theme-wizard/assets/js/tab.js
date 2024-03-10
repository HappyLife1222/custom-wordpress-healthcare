section_block_id();

function openCity(evt, cityName) {
    var i, wee_tabcontent, tablinks;
    wee_tabcontent = document.getElementsByClassName("wee-tabcontent");
    for (i = 0; i < wee_tabcontent.length; i++) {
        wee_tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function section_block_id(){
  var url_string = window.location;
  var url = new URL(url_string);
  var tab_id = url.searchParams.get("tab");
  if (tab_id == 'gutenberg_import') {

  }
}
