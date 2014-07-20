(function($){
var catalog_it = function(){

}

    catalog_it.prototype.ajaxCategorySubmission = function(element){
        $.ajax({
            type:'post',
            url:'controllers/getCategories.php',
            data: element.serialize(),
            success: function(data){
                $('.mainCatalog').html(data);
            }
        })
    }


    catalog_it.prototype.ajaxInformationSubmission = function(element){
        $.ajax({
            type:'post',
            url:'controllers/getInformation.php',
            data: element.serialize(),
            success: function(data){

            }
        })
    }

    catalog_it.prototype.addNewCategoryRow = function(element){
        element.before('<input type="text" name="category"/><br /> ')
    }

    catalog_it.prototype.clonePreviousRow = function(element, wrapperClass){
        var cloneItem = element.prev('form').children('.'+wrapperClass).html();
        element.prev('form').children('div.'+wrapperClass).after('<div class="'+wrapperClass+'">'+cloneItem+'</div>');
    }

    catalog_it.prototype.deleteRow = function(element){
      var inputRemove = element.prev('input')
        inputRemove.remove();
        element.remove();
    };

window.catalog_it = catalog_it;



    $(document).ready(function(){
        $('form.category').submit(function(){
            catalog_it.prototype.ajaxCategorySubmission($(this));
            return false;
        })

        $(document).on('submit','form.informationForm', function(){
            catalog_it.prototype.ajaxInformationSubmission($(this));
            return false;
        })


        $('.addNewCategoryRow').click(function(){
            catalog_it.prototype.addNewCategoryRow($(this));
        })


        $(document).on('click','.newCategoryInfoRow',function(){
            catalog_it.prototype.clonePreviousRow($(this), "categoryInfoContainer");
        });

        $(document).on('click','span.delete',function(){
            catalog_it.prototype.deleteRow($(this));
        });




    })


}(jQuery))



$(document).ajaxStop(function(){

});