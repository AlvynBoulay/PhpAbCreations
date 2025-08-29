document.addEventListener("DOMContentLoaded", () => {
  const toast = document.getElementById("success-toast");
  if (toast) {
    toast.classList.add("show");

    setTimeout(() => {
      toast.classList.remove("show");
      toast.style.display = "none";
    }, 3000);
  }
});
