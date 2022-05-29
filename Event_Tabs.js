function openTab(evt, eventName) {
  var y = document.getElementById('Event_List');
    y.style.display = "block";
  

  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Set variable x as pointer to the elements of the selected tab for simplicity
  var x = document.getElementById(eventName);
  
  // Set initial value of x.style.display of the tab to "none" if it has empty value
  if(x.style.display === ""){
    x.style.display = "none";
  }
  
  //If the selected tab is not displayed, quickly erase all contents of the displayed tab and display the selected tab and add class active
  if(x.style.display === "none") {
    
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    
    x.style.display = 'block';
    
    evt.currentTarget.className += " active";

  //If the selected tab has already been displayed, simply erase the displayed tab and remove the class "active"
  } else {
    
    x.style.display = "none";
    
    for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
  }
  
  changeName(tablinks); //calls function to change title name of the button

}


//function that changes title name of the button
function changeName(tablinks) {
  var y = document.getElementById('Event_List');

  //Resets names of the button
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].innerText = tablinks[i].value;
  }
  
  //Searches for the active button and changes it inner Text to "Return to Event List"
  for (i = 0; i < tablinks.length; i++) {
    if(tablinks[i].className == "tablinks active"){
      tablinks[i].innerText = "Return to Event List";
      y.style.display = "none";
      break;
    }
  }
   
    
  
}
