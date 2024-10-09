// function confirmation(ev){
//     ev.preventDefault();
//     var urlToRedirect = ev.currentTarget.getAttribute('href');
//     console.log(urlToRedirect);
//     swal({
//         title: "Are you sure to Delete this?",
//         text: "You won't be able to revert this delete",
//         icon: "warning",
//         buttons: true,
//         dangerMode: true,
//     })

//     .then((willCancel) =>
//     {
//         if (willCancel)
//         {
//             window.location.href=urlToRedirect;
//         }
//     });
// }
function confirmation(ev, Id) {
    ev.preventDefault(); // Prevent the default form submission
    console.log("Button clicked");
    Swal.fire({
        title: "Are you sure to Delete this?",
        text: "You won't be able to revert this delete",
        icon: "warning",
        showCancelButton: true, // Show the cancel button
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!", // Label for the cancel button
        dangerMode: true,
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Yes, delete it!"
            console.log("User confirmed deletion");
            document.getElementById(`deleteForm-${Id}`).submit(); // Submit the form
        }
        // else if (result.dismiss === Swal.DismissReason.cancel) {
        //     // If the user clicks "No, cancel!"
        //     console.log("User cancelled deletion");
        //     Swal.fire(
        //         'Cancelled',
        //         'Your file is safe!',
        //         'error'
        //     );
        // }
    })
}
