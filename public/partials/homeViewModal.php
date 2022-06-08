<div class="modal fade" id="deleteCourseModal" tabindex="-1" aria-labelledby="deleteCourseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="/delete-course" id="deleteCourseForm" class="w-100">
                <input type="hidden" id="deleteCourseInputHidden" name="id">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteCourseModalLabel">Suppression du jeu de piste</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-muted">
                    <p>
                        Le jeu de piste sera définitivement supprimé et ne pourra plus être récupéré.
                    </p>
                    <p>
                        Êtes-vous sûr de vouloir supprimer le jeu de piste <strong><i id="deleteCourseName"></i></strong> ?
                    </p>
                </div>
                <div class="modal-footer">
                    <div id="divBtnDeleteCourse">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button class="btn btn-danger" type="submit">Supprimer</button>
                    </div>
                    <div class="spinner-border text-danger hide-custom" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>