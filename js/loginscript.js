function showAlert() {
    Swal.fire({
        title: '<strong>Contact <u><b>Head Administrator!</b></u></strong>',
        icon: 'info',
        iconColor: 'purple',
        html:
          'Only Head Administrator can do this at the moment <br> ' +
          'Find him at: <a href="mailto:nenad@engy.solutions">nenad@engy.solutions</a>',
        showCloseButton: true,
        showCancelButton: false,
        focusConfirm: true,
        confirmButtonText:
          '<i class="fa fa-thumbs-up"></i> Great!',
        confirmButtonAriaLabel: 'Thumbs up, great!',
        cancelButtonText:
          '<i class="fa fa-thumbs-down"></i>',
        cancelButtonAriaLabel: 'Thumbs down'
      })
  }

