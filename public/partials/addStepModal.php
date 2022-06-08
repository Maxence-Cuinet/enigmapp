<div class="modal fade" id="addStepModal" tabindex="-1" aria-labelledby="addStepModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStepModalLabel">Ajout d'une étape</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-muted">
                <form id="formAddStep" class="w-100">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <label for="">Nom de l'étape<i class="fa fa-asterisk"></i> :</label>
                                <input type="text" class="form form-control" name="name" id="nameAddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Description<i class="fa fa-asterisk"></i> : </label>
                                <textarea class="form form-control" name="description" id="descriptionAddStep" cols="30" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Illustration :</label>
                                <input type="file" class="form form-control" name="img" id="imgAddStep">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Question<i class="fa fa-asterisk"></i> :</label>
                                <input type="text" name="question" id="questionAddStep" class="form form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Réponse 1 (Bonne réponse)<i class="fa fa-asterisk"></i> : </label>
                                <input type="text" class="form form-control" name="answer1" id="answer1AddStep">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Réponse 2<i class="fa fa-asterisk"></i> : </label>
                                <input type="text" class="form form-control" name="answer2" id="answer2AddStep">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="">Réponse 3<i class="fa fa-asterisk"></i> : </label>
                                <input type="text" class="form form-control" name="answer3" id="answer3AddStep">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-success" id="btnSubmitAddStep">Ajouter l'étape</button>
                <div class="spinner-border text-success hide-custom" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>
        </div>
    </div>
</div>