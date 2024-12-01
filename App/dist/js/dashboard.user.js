function show(show, hide, id, id2) {
    // show
    document.getElementById(show).classList.add('d-block')
    document.getElementById(show).classList.remove('d-none')
    document.getElementById(id).classList.add('active')
    
    // hide
    document.getElementById(hide).classList.add('d-none')
    document.getElementById(hide).classList.remove('d-block')
    document.getElementById(id2).classList.remove('active')

}