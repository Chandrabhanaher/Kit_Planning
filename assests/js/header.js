function updateFlag_confirm(){
    if($('.checkbox:checked').length > 0){
        var result = confirm("Are you sure to add this articles in frozen?");
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Select at any 1 article no.');
        return false;
    }
}
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
	
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});

function pick_flag_confirm(){
     if($('.checkbox:checkbox1').length > 0){
        var result = confirm("Are you sure to add this articles in frozen?");
        if(result){
            return true;
        }else{
            return false;
        }
    }else{
        alert('Select at any 1 article no.');
        return false;
    }
}
$(document).ready(function(){
    $('#select_alls').on('click',function(){
        if(this.checked){
            $('.checkbox1').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox1').each(function(){
                this.checked = false;
            });
        }
    });
	
    $('.checkbox1').on('click',function(){
        if($('.checkbox:checkbox1').length == $('.checkbox1').length){
            $('#select_alls').prop('checked',true);
        }else{
            $('#select_alls').prop('checked',false);
        }
    });
});