/* Function For Create Modal */

function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('#createvendor').on('show.bs.modal', function (e) {
    var anim = $('#entrance').val();
    testAnim(anim);
})
$('#createvendor').on('hide.bs.modal', function (e) {
    var anim = $('#exit').val();
    testAnim(anim);
});

/* Function For Create Modal */

/* Function For Edit Modal */

function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('.editvendor').on('show.bs.modal', function (e) {
    var anim = $('#editentrance').val();
    testAnim(anim);
})
$('.editvendor').on('hide.bs.modal', function (e) {
    var anim = $('#editexit').val();
    testAnim(anim);
});

/* Function For Edit Modal */

/* Function For Show Modal */

function testAnim(x) {
    $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
};
$('.showvendor').on('show.bs.modal', function (e) {
    var anim = $('#showentrance').val();
    testAnim(anim);
})
$('.showvendor').on('hide.bs.modal', function (e) {
    var anim = $('#showexit').val();
    testAnim(anim);
});

/* Function For Show Modal */






