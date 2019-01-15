
$(function() {
    $('.btn.btn-danger').click(function(e) {
        e.preventDefault();
        if (window.confirm("Are you sure ? Otherwise click cancel.")) {
            location.href = this.href;
        }
    });
});
