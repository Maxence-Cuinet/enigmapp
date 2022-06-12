<div class="modal fade" id="addStepModal" tabindex="-1" aria-labelledby="addStepModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formAddStep" class="w-100" autocomplete="off">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStepModalLabel">Ajout d'une étape</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-muted">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <strong><label for="">N° de l'étape* :</label></strong>
                                <input type="number" class="form form-control" name="order" id="orderAddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Nom de l'étape* :</label></strong>
                                <input type="text" class="form form-control" name="name" id="nameAddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Description* : </label></strong>
                                <textarea class="form form-control" name="description" id="descriptionAddStep" cols="30" rows="5" required></textarea>
                            </div>
                        </div>
                        <br>
                        <!--
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Illustration :</label></strong>
                                <input type="file" class="form form-control" name="img" id="imgAddStep" accept="image/png, image/jpeg">
                                <i>Une image par défaut sera utilisée si vous n'en ajouter pas</i> <a href="javascript:void(0)" data-bs-trigger="hover" data-bs-html="true" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" data-bs-content="<img src='/img/step.png' class='img-fluid'>"><i class="fa fa-info-circle"></i></a>
                            </div>
                        </div>
                        <br> ON NE GERE PAS ENCORE L'UPLOAD DE FICHIER A FAIRE PLUS TARD -->
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Question* :</label></strong>
                                <input type="text" name="question" id="questionAddStep" class="form form-control" required>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Réponse 1 (Bonne réponse)* : </label></strong>
                                <input type="text" class="form form-control" name="answer1" id="answer1AddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Réponse 2* : </label></strong>
                                <input type="text" class="form form-control" name="answer2" id="answer2AddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Réponse 3* : </label></strong>
                                <input type="text" class="form form-control" name="answer3" id="answer3AddStep" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <strong><label for="">Indice (Sera montrer si le joueur se trompe une fois) : </label></strong>
                                <input type="text" class="form form-control" name="indice" id="indiceAddStep">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-success" id="btnSubmitAddStep" type="submit">Ajouter l'étape</button>
                    <button class="btn btn-warning hide-custom" id="btnSubmitChangeStep" type="button">Modifier l'étape</button>
                </div>
            </form>
        </div>
    </div>
</div>