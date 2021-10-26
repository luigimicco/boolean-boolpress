const deleteButtons = document.querySelectorAll(".delete-button");
deleteButtons.forEach(form => {
    form.addEventListener("submit", function(e) {
        e.preventDefault();
        const conf = confirm("Are you sure you want to delete this post?");
        if (conf) this.submit();
    });
});
