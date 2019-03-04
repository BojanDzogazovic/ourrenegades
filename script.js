//Bootstrap jQuery dependencies
$(document).ready(function(){
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
  if (this.hash !== "") {
    event.preventDefault();
    var hash = this.hash;
    $('html, body').animate({
      scrollTop: $(hash).offset().top
    }, 900, function(){
      window.location.hash = hash;
      });
    } 
  });
})

$(window).scroll(function() {
  $(".slidexanim").each(function(){
    var pos = $(this).offset().top;
        var winTop = $(window).scrollTop();
        if (pos < winTop + 600) {
          $(this).addClass("slidex");
        }
    });
});

$(document).on('click','.navbar-collapse.in',function(e) {
  if( $(e.target).is('a') ) {
      $(this).collapse('hide');
  }
});


//vanilla js

//Form input event listeners
let sendAnswer = document.getElementById("sendAnswerBtn");
let sentModal = document.getElementById("myModalh");
let radioButtons = document.querySelectorAll(".answerOption");
let isChecked = false;
let validName = false;
let validEmail = false;
let options = Array.prototype.slice.call(radioButtons);
let name = document.getElementById("name");
let nameLength = document.getElementById("name_length");
let email = document.getElementById("email");
let emailLength = document.getElementById("email_length");
let optionsErr = document.getElementById("optionsErr");

name.addEventListener("input", function(){
  updateLength(name, nameLength);
  validateName();
});
 
email.addEventListener("input", function(){
  updateLength(email, emailLength);
  validateEmail();
});

sendAnswer.addEventListener("click", ()=>{
   options.forEach(option=> {
    if(option.checked){
      isChecked = true;
    }
  });

  if(!isChecked){
    optionsErr.style.display = "block";
    setTimeout(() => {
      optionsErr.style.display = "none";
    }, 1500);
  } else if(isChecked){
      validateName();
      validateEmail();
      if(validName && validEmail){
        $("#myModalh").modal("toggle");
        clearFields();
      }
  }
});


//check name and email remain letters
function updateLength(field, output) {
  curr_length = field.value.length;
  field_max = field.maxLength;
  output.innerHTML = curr_length +'/'+ field_max;
}


//validate name
function validateName() {
    let comment1 = document.getElementById("comment1");
    let regEx = /^[a-zA-Z]{2,20}$/;

  
    
    name.classList.remove("failed");
    name.classList.remove("success");
    comment1.innerText= "";

    if(!regEx.test(name.value)) {
      comment1.innerText = "Your name must be between 2 and 20 characters, and can include only letters A-z and spaces.";
      name.classList.add("failed");
      validName = false;
       setTimeout(() => {
        comment1.innerText = "";
      }, 1000); 
    } else if (regEx.test(name.value)){
      name.classList.remove("failed");
      comment1.innerText = "";
      name.classList.add("success");
      validName = true;
    }
    return validName;
}

//validate email
function validateEmail() {
      let comment2 = document.getElementById("comment2");
      let regEx = /^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/;

    

      email.classList.remove("failed");
      email.classList.remove("success");
      comment2.innerText= "";

        if(!regEx.test(email.value)) {
            comment2.innerText = "Please enter valid email!";
            email.classList.add("failed");
            validEmail = false;
            setTimeout(() => {
            comment2.innerText = "";
          }, 1000);  
        } else if (regEx.test(email.value) && email.value !== "") {
          email.classList.remove("failed");
          comment2.innerText= "";
          email.classList.add("success");
          validEmail = true;
        }
        return validEmail;
}


function clearFields(){
  name.value = "";
  email.value = "";
  name.classList.remove("success");
  email.classList.remove("success");
  options.forEach(option => {
    option.checked = false;
  });
}


























