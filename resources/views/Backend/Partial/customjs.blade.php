<script src="{{asset('js/jquery-3.6.0.js')}}"></script>
<script>
    $('#checkPermissionAll').click(function() {
        if ($(this).is(':checked')) {
            // check all the checkbox
            $('input[type=checkbox]').prop('checked', true);
        } else {
            // uncheck all the checkbox
            $('input[type=checkbox]').prop('checked', false);
        }
    })
</script>
<script>
    function checkPermissionByGroup(className, checkThis) {
        const groupIdName = $("#" + checkThis.id);
        const classCheckbox = $('.' + className + ' input');
        if ($(groupIdName).is(':checked')) {
            // check all the checkbox
            classCheckbox.prop('checked', true);
        } else {
            // uncheck all the checkbox
            classCheckbox.prop('checked', false);
        }
    }
</script>

<script>
  function checkSinglePermission(groupClassName, groupID, countTotalPermission) {
            const classCheckbox = $('.'+groupClassName+ ' input');
            const groupIDCheckBox = $("#"+groupID);
            // if there is any occurance where something is not selected then make selected = false
            if($('.'+groupClassName+ ' input:checked').length == countTotalPermission){
                groupIDCheckBox.prop('checked', true);
            }else{
                groupIDCheckBox.prop('checked', false);
            }
            implementAllChecked();
         }
</script>
<script>
    function implementAllChecked() {
             const countPermissions = {{ count($all_permissions) }};
             const countPermissionGroups = {{ count($permission_groups) }};
            //  console.log((countPermissions + countPermissionGroups));
            //  console.log($('input[type="checkbox"]:checked').length);
             if($('input[type="checkbox"]:checked').length >= (countPermissions + countPermissionGroups)){
                $("#checkPermissionAll").prop('checked', true);
            }else{
                $("#checkPermissionAll").prop('checked', false);
            }
         }

</script>