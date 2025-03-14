<div class="modal fade" id="new-student-modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Payment <span class=""></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form-row g-3" id="new-student">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Student</label>
                            <select name="student_id" class="form-select" placeholder="-- Select Student --">
                                @foreach($students as $key => $student)
                                <option value="{{$student->id}}">{{$student->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label">Course</label>
                            <select name="course_id" class="form-select" placeholder="-- Select Course --">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label">Amount</label>
                            <input type="number" class="form-control" name="amount" autocomplete="off">
                        </div>
                        <div class="col-6">
                            <label class="form-label">Date</label>
                            <input type="text" class="form-control" name="date_of_payment" autocomplete="off">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
