jQuery(document).ready(function($){

    jQuery('#btn-add').click(function () {
        jQuery('#btn-save').val("store");
        jQuery('#modalFormData').trigger("reset");
        jQuery('#financialIndicatorModal').modal('show');
    });

    jQuery('.open-model').click(function () {
        var id = $(this).val();
        $.get(route('financialIndicators.edit', id) , function (data) {
            jQuery('#id').val(data.id);
            jQuery('#name').val(data.name);
            jQuery('#code').val(data.code);
            jQuery('#unit').val(data.unit);
            jQuery('#value').val(data.value);
            jQuery('#date').val(data.date);
            jQuery('#origin').val(data.origin);
            jQuery('#time').val(data.time);
            jQuery('#btn-save').val("update");
            jQuery('#financialIndicatorModal').modal('show');
        })
    });

    jQuery("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var data = {
            name: jQuery('#name').val(),
            code: jQuery('#code').val(),
            unit: jQuery('#unit').val(),
            value: jQuery('#value').val(),
            date: jQuery('#date').val(),
            origin: jQuery('#origin').val(),
            time: jQuery('#time').val()
        };
        var action = jQuery('#btn-save').val();
        var method = "POST";
        var id = jQuery('#id').val();
        var url = route('financialIndicators.store');
        if (action !== "store") {
            method = "PUT";
            url =  route('financialIndicators.update', id);
        }
        $.ajax({
            type: method,
            url: url,
            data: data,
            dataType: 'json',
            success: function (data) {
                if (action == "store") {
                    jQuery('#financialIndicators-list')
                        .append($('<tr>')
                            .attr('id', 'financialIndicator-'+data.record.id)
                            .append($('<th>')
                                .attr('id', 'id-'+data.record.id)
                                .text(data.record.id)
                            )
                            .append($('<td>')
                                .attr('id', 'name-'+data.record.id)
                                .text(data.record.name)
                            )
                            .append($('<td>')
                                .attr('id', 'code-'+data.record.id)
                                .text(data.record.code)
                            )
                            .append($('<td>')
                                .append($('<button>')
                                    .attr('value', data.record.id)
                                    .attr('class', 'btn btn-sm btn-primary open-model')
                                    .attr('data-bs-toggle', 'modal')
                                    .attr('data-bs-target', '#financialIndicatorModal')
                                    .text('Edit')
                                )
                                .append($('<button>')
                                    .attr('value', data.record.id)
                                    .attr('class', 'btn btn-sm btn-primary delete-financialIndicator')
                                    .text('Delete')
                                )
                            )
                        )
                        location.reload();
                } else {
                    $("#id-" + id).text(data.record.id);
                    $("#name-" + id).text(data.record.name);
                    $("#code-" + id).text(data.record.code);
                }
                jQuery('#modalFormData').trigger("reset");
                jQuery('#financialIndicatorModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    jQuery('.delete-financialIndicator').click(function () {
        var id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "DELETE",
            url: route('financialIndicators.destroy', id),
            success: function (data) {
                $("#financialIndicator-" + id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });
});