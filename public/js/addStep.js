$(document).ready(() => {
    $('[data-bs-toggle="popover"]').popover()
    
    $(document).on('click', '#btnAddStep', function(e){
        e.preventDefault()
        $('#btnSubmitAddStep').show()
        $('#btnSubmitChangeStep').hide()
        $('#addStepModal').modal('show')
    })

    $(document).on('submit', '#formAddStep', function(e){
        e.preventDefault()
        let name = $('#nameAddStep').val()
        let description = $('#descriptionAddStep').val()
        let question = $('#questionAddStep').val()
        let answer1 = $('#answer1AddStep').val()
        let answer2 = $('#answer2AddStep').val()
        let answer3 = $('#answer3AddStep').val()

        let rows = $('#stepTable > tbody > tr')
        let id = 1 + Math.floor(Math.random() * 1000) + Date.now(); //Génère un nb aléatoire en 1 et 1000 
        let tr = $('<tr id="step_'+id+'"><td><span class="num-step"></span></td><td><a href="javascript:void(0)" class="change-step" data-id="'+id+'" data-name="'+name+'" data-description="'+description+'" data-question="'+question+'" data-answer1="'+answer1+'" data-answer2="'+answer2+'" data-answer3="'+answer3+'">'+name+'</a></td><td><a href="javascript:void(0)" data-id="'+id+'" class="remove-step"><i class="fa fa-times fa-xl text-danger"></i></a></td></tr>')
        rows.push(tr)
        console.log(rows)
        drawStepTable(rows)

        $('#addStepModal').modal('hide')
        $('#divStepTable').slideDown()

        let val = JSON.stringify({
            "name": name,
            "description": description,
            "question": question,
            "url_img": "/img/step.png", //On ne gère pas encore l'upload de fichier à faire plus tard
            "answer1": answer1,
            "answer2": answer2,
            "answer3": answer2,
        })


        $('#divStepHidden').append('<input id="input_step_'+id+'" type="hidden" name="step[]" value=\''+val+'\'>')
    })

    $(document).on('click', '#btnSubmitChangeStep', function(e){
        e.preventDefault()
        let name = $('#nameAddStep').val()
        let description = $('#descriptionAddStep').val()
        let question = $('#questionAddStep').val()
        let answer1 = $('#answer1AddStep').val()
        let answer2 = $('#answer2AddStep').val()
        let answer3 = $('#answer3AddStep').val()

        let old_id = $(this).data('id')
        $('#step_'+old_id).remove()
        $('#input_step_'+old_id).remove()

        let rows = $('#stepTable > tbody > tr')
        let id = 1 + Math.floor(Math.random() * 1000) + Date.now(); //Génère un nb aléatoire en 1 et 1000
        let tr = $('<tr id="step_'+id+'"><td><span class="num-step"></span></td><td><a href="javascript:void(0)" class="change-step" data-id="'+id+'" data-name="'+name+'" data-description="'+description+'" data-question="'+question+'" data-answer1="'+answer1+'" data-answer2="'+answer2+'" data-answer3="'+answer3+'">'+name+'</a></td><td><a href="javascript:void(0)" data-id="'+id+'" class="remove-step"><i class="fa fa-times fa-xl text-danger"></i></a></td></tr>')
        rows.push(tr)
        drawStepTable(rows)

        $('#addStepModal').modal('hide')
        $('#divStepTable').slideDown()

        let val = JSON.stringify({
            "name": name,
            "description": description,
            "question": question,
            "url_img": "/img/step.png", //On ne gère pas encore l'upload de fichier à faire plus tard
            "answer1": answer1,
            "answer2": answer2,
            "answer3": answer2,
        })

        //name a modifier trouver le bon format
        $('#divStepHidden').append('<input id="input_step_'+id+'" type="hidden" name="step[]" value=\''+val+'\'>')
    })
    $(document).on('click', '.change-step', function(e){
        e.preventDefault()
        let name = $(this).data('name')
        let description = $(this).data('description')
        let question = $(this).data('question')
        let answer1 = $(this).data('answer1')
        let answer2 = $(this).data('answer2')
        let answer3 = $(this).data('answer3')

        let id = $(this).data('id')
        $('#btnSubmitChangeStep').data('id', id)
        $('#btnSubmitAddStep').hide()
        $('#btnSubmitChangeStep').show()

        $('#nameAddStep').val(name)
        $('#descriptionAddStep').val(description)
        $('#questionAddStep').val(question)
        $('#answer1AddStep').val(answer1)
        $('#answer2AddStep').val(answer2)
        $('#answer3AddStep').val(answer3)

        $('#addStepModal').modal('show')
    });

    $(document).on('click', '.remove-step', function(e){
        e.preventDefault();
        $(this).parent().parent().remove()
        let id = $(this).data('id')
        $('#input_step_'+id).remove();
        let rows = $('#stepTable > tbody > tr')
        drawStepTable(rows)
        if(rows.length < 1){
            $('#divStepTable').slideUp()
        }
    })
});

function drawStepTable(rows){
    $('#stepTable > tbody').html('')
    for(let i = 0; i<rows.length; i++){
        $(rows[i]).find('.num-step').text(i+1)
        $('#stepTable > tbody').append(rows[i])
    }
}