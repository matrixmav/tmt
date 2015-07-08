<form class="form-horizontal" role="form" action="#" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="note">User Name:</label>
        <div class="col-sm-6">
            <?php echo $userObject->full_name; ?>
        </div>
    </div>

    <div class="form-group">
        <div class="horigantal">
            <label> <input type="checkbox" name="access[]" value="funchin">Funch In </label>
            <label> <input type="checkbox" name="access[]" value="bugreport">Bug Report </label>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</form>