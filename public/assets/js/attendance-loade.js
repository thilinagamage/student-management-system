$(document).ready(function () {

    $('#batch_id').on('change', function () {

        let batchId = $(this).val();

        if (!batchId) return;

        let url = window.getStudentsUrl.replace(':id', batchId);

        $.ajax({
            url: url,
            type: 'GET',
            success: function (response) {

                let tbody = $('#studentsTableBody');
                tbody.empty();

                if (response.length === 0) {
                    tbody.append(
                        `<tr><td colspan="6" class="text-center">No students found</td></tr>`
                    );
                    return;
                }

                $.each(response, function (index, student) {
                    tbody.append(`
                        <tr>
                            <td>${index + 1}</td>
                            <td>${student.first_name} ${student.last_name}</td>
                            <td>${student.student_code}</td>
                            <td class="text-center">
                                <input type="radio" name="attendance[${student.id}]" value="present" required>
                            </td>
                            <td class="text-center">
                                <input type="radio" name="attendance[${student.id}]" value="absent">
                            </td>
                            <td class="text-center">
                                <input type="radio" name="attendance[${student.id}]" value="late">
                            </td>
                        </tr>
                    `);
                });
            },
            error: function () {
                alert('Failed to load students');
            }
        });

    });

});
