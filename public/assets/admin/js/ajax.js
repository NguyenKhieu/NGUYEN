$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


jQuery(document).ready(function ($) {
    var update_id;

//Category

    function showCategory() {
        $.ajax({
            url: 'admincp/show_category',
            type: 'get',
            dataType: 'json',
            success: function (result) {
                $('#category-crud').empty()
                result.data.forEach(row => {
                    var status = (row.status == 1) ? 'Hiển thị' : 'Không hiển thị'
                    var object = `<tr class="category-`+row.id+`">
		                        <td>` + row.id + `</td>
		                        <td>` + row.name + `</td>
		                        <td>` + row.slug + `</td>
		                        <td>` + status + `
		                        </td>
		                        <td>
		                        	<button class="btn btn-primary edit" title="Sửa + row.name +"data-toggle="modal" data-target="#edit" type="button" data-id =" `+row.id+`"><i class="fas fa-edit" ></i></button>
		                        	<button class="btn btn-danger delete" title="Xoa + row.name +"data-toggle="modal" data-target="#delete" type="button" data-id = "`+row.id+`"><i class="fas fa-trash-alt" ></i></button>
		                        </td>
		                    </tr>`
                    $('#category-crud').append(object);
                })
            }
        });
    }
    showCategory()

    $('body').on('click', '.edit', function () {
        $('.error').hide();
        /* Act on the event */
        let id = $(this).data('id');
        update_id = id;
        //edit
        $.ajax({
            url: 'admincp/category/' + id + '/edit',
            type: 'get',
            dataType: 'json',
            success: function ($result) {

                $('.name').val($result.name);
                $('.id-category').val($result.id);
                $('.title').text($result.name);
                $('.status').val($result.status);
            }
        });
    });
    $('.update').click(function () {
        $.ajax({
            url: 'admincp/category/' + update_id,
            data: $('#categoryForm').serialize(),
            type: 'put',
            dataType: 'json',
            success: function (result) {
                console.log(result);

                toastr.success(result.success, 'Edit success', {timeOut: 5000});
                $('#edit').modal('hide');

                showCategory()
            },
            error: function (data) {
                let error = $.parseJSON(data.responseText);

                if (error.errors.name != " ") {
                    $('.error').show();
                    $('.error').text(error.errors.name);
                }
            }
        });
    });

    $(document).on('click', '.delete', function (event) {
        let id = $(this).data('id');
        console.log(id);
        // $('.xoa').click(function (event) {
        //     $.ajax({
        //         url: 'admincp/category/' + id,
        //         type: 'delete',
        //         dataType: 'json',
        //         success: function (result) {
        //             toastr.success(result.success, 'Thông báo', {timeOut: 5000});
        //             $('#delete').modal('show');
        //
        //             // showCategory()
        //         }
        //     });
        // });
        $('#delete').modal('show');
        $('.del').click(function(){
            $.ajax({
                url: 'admincp/category/' + id,
                type: 'delete',
                dataType : 'JSON',
                success: function(data) {
                    // toastr.success(data.success, 'Success Alert', {timeOut: 500});
                    $('#delete').modal('hide');
                    $('.category-'+id).remove();
                    // $('.item' + data['id']).remove();
                }
            });
        });
    });



// ProductType

    function showProductType() {
        $.ajax({
            url: 'admin/show_producttype',
            type: 'get',
            dataType: 'json',
            success: function (result) {
                $('#producttype-crud').empty();
                $.each(result.productType.data, function (key, value) {
                    var category = result.category.filter(function (check) {
                        return check.id == value.id_category;
                    })

                    var status = (value.status == 1) ? 'Hiện thị' : 'Không hiển thị'
                    var object = `<tr>
		                        <td>` + value.id + `</td>
		                        <td>` + value.name + `</td>
		                        <td>` + value.slug + `</td>
		                        <td>` + category[0].name + `</td>
		                        <td>` + status + `
		                        </td>
		                       	<td>
		                        	<button class="btn btn-primary editProductType" title="Sửa + value.name +"data-toggle="modal" data-target="#editproducttype" type="button" data-id ="`+value.id+`"><i class="fas fa-edit" ></i></button>
	 	                        	<button class="btn btn-danger deleteProductType" title="Xóa + value.name +"data-toggle="modal" data-target="#deleteproducttype" type="button" data-id ="`+value.id+`"><i class="fas fa-trash-alt" ></i></button>
		                        </td>
		                    </tr>`
                    $('#productType-crud').append(object);
                });
            }
        });
    }

    // function showProductType() {
    //     $.ajax({
    //         url: 'admincp/show_producttype',
    //         type: 'get',
    //         dataType: 'json',
    //         success: function (result) {
    //
    //             $('#producttype-crud').empty();
    //             $.each(result.producttype.data, function (key, value) {
    //                 var category = result.category.filter(function (check) {
    //                     return check.id == value.id_producttype;
    //                 })
    //
    //                 var status = (value.status == 1) ? 'Hiện thị' : 'Không hiển thị'
    //                 var object = `<tr>
	// 	                        <td>` + value.id + `</td>
	// 	                        <td>` + value.name + `</td>
	// 	                        <td>` + value.slug + `</td>
	// 	                        <td>` + category[0].name + `</td>
	// 	                        <td>` + status + `
	// 	                        </td>
	// 	                        <td>
	// 	                        	<button class="btn btn-primary editProductType" title="Sửa + value.name +"data-toggle="modal" data-target="#editproducttype" type="button" data-id ="`+value.id+`"><i class="fas fa-edit" ></i></button>
	// 	                        	<button class="btn btn-danger deleteProductType" title="Xóa + value.name +"data-toggle="modal" data-target="#deleteproducttype" type="button" data-id ="`+value.id+`"><i class="fas fa-trash-alt" ></i></button>
	// 	                        </td>
	// 	                    </tr>`
    //                 $('#producttype-crud').append(object);
    //             });
    //         }
    //     });
    // }

    showProductType()
    $('body').on('click', '.editProductType', function () {
        $('.error').hide();
        /* Act on the event */
        let id = $(this).data('id');
        update_id = id;
        //edit
        $.ajax({
            url: 'admincp/producttype/' + id + '/edit',
            type: 'get',
            datatype: 'json',
            success: function (result) {
                console.log(result);
                $('.name').val(result.producttype.name);
                $('.id-product-type').val(result.producttype.idCategory);
                $('.title').text(result.producttype.name);
                $('.idCategory').empty();
                $.each(result.category, function (key, value) {
                    console.log(result.producttype.idCategory)
                    if (value['id'] == result.producttype.idCategory) {
                        var option = `<option value="${value['id']}" selected> ${value['name']}</option>`
                        $('.idCategory').append(option)
                    } else {
                        var option = `<option value="${value['id']}">${value['name']}</option>`
                        $('.idCategory').append(option)
                    }
                    // if (value['id'] == result.producttype.id_category) {
                    //     var option = <option value=" + value['id'] + " selected> + value['name'] + </option>
                    //     $('.idCategory').append(option)
                    // } else {
                    //     var option = <option value=" + value['id'] + "> + value['name'] + </option>]
                    //     $('.idCategory').append(option)
                    // }
                });
                $('.status').val(result.producttype.status);
            }
        });
    });
    $('.updateProductType').click(function () {
        $.ajax({
            url: 'admincp/producttype/' + update_id,
            data: $('.productTypeForm').serialize(),
            type: 'put',
            dataType: 'json',
            success: function (result) {
                console.log(result);

                toastr.success(result.success, 'Edit success', {timeOut: 5000});
                $('.editproducttype').modal('hide');

                showProductType()
            },
            error: function (data) {
                let error = $.parseJSON(data.responseText);

                if (error.errors.name != " ") {
                    $('.error').show();
                    $('.error').text(error.errors.name);
                }
            }
        });
    });




    $('body').on('click', '.deleteProductType', function () {
        $('#delete').modal('show');
        let id = $(this).data('id');
        $('.delProductType').click(function () {
        console.log(id)
            $.ajax({
                url: 'admincp/producttype/' + id,
                type: 'DELETE',
                datatype:'JSON',
                success: function (result) {
                    console.log(result)
                    toastr.success(result.success, 'Thông báo', {timeOut: 5000});
                    $('#delete').modal('hide');
                    showProductType()
                },
            })
        });
    })




});

