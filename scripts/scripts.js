(function($){
var catalog_it = function(){

}

    Array.prototype.chunk = function(chunkSize) {
        var array=this;
        return [].concat.apply([],
            array.map(function(elem,i) {
                return i%chunkSize ? [] : [array.slice(i,i+chunkSize)];
            })
        );
    }

    catalog_it.prototype.userCreate = function(element){
        $.ajax({
            type:'post',
            url:'controllers/userCreate.php',
            data:element.serialize(),
            success: function(data){
                window.location = '/catalogIt';
            }
        })
    }


    catalog_it.prototype.userLogin = function(element){
        $.ajax({
            type:'post',
            url:'controllers/userLogin.php',
            data:element.serialize(),
            success: function(data){
                window.location = '/catalogIt';
            }
        })
    }

    catalog_it.prototype.destroySession = function(){
        $.ajax({
            type:'post',
            url:'controllers/destroySession.php',
            success: function(data){
                window.location='/catalogIt';
            }
        })
    };

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

    catalog_it.prototype.ajaxInformationSubmission = function(element, numberOfRows, numberOfFields){

        var a = element.serializeArray();
        var dataArray = a.chunk(numberOfFields/numberOfRows);

        $.ajax({
            type:'post',
            url:'controllers/getInformation.php',
            data:JSON.stringify(dataArray),
            success: function(data){
                $('body').append(data);
            }
        })
    }

    catalog_it.prototype.addNewCategoryRow = function(element){
        var randoms = Math.ceil(Math.random()*100);
        element.before('<input type="text" name="category'+randoms+'"/><br /> ')    }

    catalog_it.prototype.clonePreviousRow = function(element, wrapperClass){
        var noOfInputs = $('.categories .category').length;
        var defaultInputs = $('<div />').addClass(wrapperClass);
        var inputNames = [];
        var cloneItem = element.prev('form').children('.'+wrapperClass);

        if(cloneItem.length > 0){
            //create row
            $('form input[type="submit"]').before('<div class="'+wrapperClass+' newrow">'+cloneItem.html()+'</div>');
            //clear values
            $('.newrow').children('input').val('');

        }else{
            defaultInputs.addClass('initialRow');
            $('form.informationForm').prepend(defaultInputs);

            $('.categories div').each(function(){
                inputNames.push($(this).text());
            })

            inputNames.reverse();

            for(var i=0;i<noOfInputs;i++){
                var newInputs = $('<input type="text" name="'+inputNames[i]+' "/>');
                $('.initialRow').prepend(newInputs);
            }
            $('.initialRow').removeClass("initialRow");
        }

            //kick off ajax to create empty row
            $.ajax({
                type:'post',
                url:'controllers/createEmptyRow.php'
            })
    }

    catalog_it.prototype.deleteRow = function(element){
      var inputRemove = element.prev('input')
        inputRemove.remove();
        element.remove();
    };

    catalog_it.prototype.deleteInfoRow = function(element){
        var inputRemove = element.prev('div.categoryInfoContainer').children('input');

        $.ajax({
            type:'post',
            url:'controllers/deleteFullRow.php',
            data:inputRemove.serialize()
        })

        inputRemove.remove();
        element.prev('div.categoryInfoContainer').remove();
        element.remove();
    };

window.catalog_it = catalog_it;


//EVENT HANDLERS
    $(document).ready(function(){
        $('form.category').submit(function(){
            catalog_it.prototype.ajaxCategorySubmission($(this));
            return false;
        })

        $('form#createUser').submit(function(){
            catalog_it.prototype.userCreate($(this));
            return false;
        })

        $('form#loginForm').submit(function(){
            catalog_it.prototype.userLogin($(this));
            return false;
        })

        $(document).on('submit','form.informationForm', function(){
            var numberOfRows = $('.categoryInfoContainer').length;
            var numberOfFields = $('.categoryInfoContainer input').length;
            catalog_it.prototype.ajaxInformationSubmission($(this), numberOfRows, numberOfFields);
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

        $(document).on('click','span.deleteInfoRow',function(){
            catalog_it.prototype.deleteInfoRow($(this));
        });


        $(document).on('click','.logout',function(){
            catalog_it.prototype.destroySession();
        });




    })


}(jQuery))



$(document).ajaxStop(function(){

});