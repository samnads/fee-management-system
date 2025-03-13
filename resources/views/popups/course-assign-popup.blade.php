<div class="modal fade" id="assign-course-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Assign Course <span class=""></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-row g-3" id="assign-course">
                <input type="hidden" name="student_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control" name="name" autocomplete="off" disabled>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label">Courses</label>
                            <select name="courses[]" class="form-select" placeholder="-- Select Courses --" multiple></select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
            </form>
        </div>
    </div>
</div>
