function redirectToPage() {
    var select = document.getElementById("redirectSelect");
    var selectedValue = select.value; 
    if (selectedValue) {
        window.location.href = selectedValue;
    }
}

document.getElementById('redirectSelect').addEventListener('change',function(){
    redirectToPage();
});