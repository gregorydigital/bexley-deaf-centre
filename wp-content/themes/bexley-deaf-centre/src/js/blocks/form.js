export default function initFormChoices() { 
    const courseSelect = document.querySelector("#acf-course-select");
    const hiddenField  = document.querySelector("input[name='text-1']"); 
  
    if (courseSelect && hiddenField) {
        courseSelect.addEventListener("change", function() {
            hiddenField.value = this.value;
        });
    }
}