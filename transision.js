window.onload = () => {
    const popup_btns = document.querySelectorAll(".popup-button");

    popup_btns.forEach(button => {
        button.addEventListener('click', e => {
            const target = e.target.dataset.target;

            const popup_el = document.querySelector(target);
            if(popup_el != null){
                popup_el.classList.toggle('is-active');
            }
            else{
                alert("Error: Popup element not found");
            }
        });
    });

    //---------Inner popup elements-------------------------------
    const navButtons = document.querySelectorAll('.nav-btn');
    const sections = document.querySelectorAll('.section');

    navButtons.forEach(button => {
      button.addEventListener('click', () => {
        const target = button.dataset.target;
        sections.forEach(section => {
          if (section.id === target) {
            section.classList.add('active');
          } else {
            section.classList.remove('active');
          }
        });
      });
    });
    //------------------------------------------------------------

}

//--------------Checkbox & Submition button activation-----------
var terms = document.getElementById("checkbox");
document.getElementById("submit").disabled = true;

terms.addEventListener("change", agreeTerms, false);
function agreeTerms() {
    if (terms.checked) {
        document.getElementById("submit").disabled = false;
    } else {
        document.getElementById("submit").disabled = true;
    }
};
//-------------------------------------------------------------
