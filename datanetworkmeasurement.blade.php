@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Рабочий стол</div>

                <div class="panel-body">
                @if($flagreport==0)
                    <form method="post" action="{{ route('addmysql') }}" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
            <input name="_token" type="hidden" value="{{ csrf_token() }}">
            </div>
            <div class="form-group">
            <label for="name" class="col-md-4 col-xs-5 col-sm-5 control-label">Примечание:</label>
            <div class="col-md-8 col-xs-7 col-sm-7">
            <input type="text" class="form-control" id="name" name="name" placeholder="Введите примечание">
            </div>
            </div>
            <div class="form-group">
            <label for="nameoborud" class="col-md-4 col-xs-5 col-sm-5 control-label">Оборудование:</label>
            <div class="col-md-8 col-xs-7 col-sm-7">
            <select id="nameoborud" name="nameoborud" class="form-control">@foreach($oborudtitles as $oborudtitle)
                    <option value='{{ $oborudtitle->id }}'>{{ $oborudtitle->nameoborud }}</option>
            @endforeach
            </select>
            </div>
            
            </div>
            <div class="form-group">
            <label for="title" class="col-md-4 col-xs-5 col-sm-5 control-label">Статус:</label>
            <div class="col-md-8 col-xs-7 col-sm-7">
            <select id="title" name="title" class="form-control">@foreach($titles as $title)
                    <option value='{{ $title->id }}'>{{ $title->title }}</option>
            @endforeach
            </select>
            </div>
            
            </div> 
            

            
            <!--<div class="form-group">
            <label for="file" class="col-md-4 col-xs-5 col-sm-5 control-label">Фото:</label>
            <div class="col-md-8 col-xs-7 col-sm-7">
            <input type="file" class="form-control" id="file" multiple name="file[]">
            </select>
            </div>
            
            
            </div>-->
            
                        
            <div class="form-group">
            <div class="col-md-12 col-xs-12 col-sm-12">
            <button type="submit" class="btn btn-primary form-control">Загрузить</button>
            </div>
            </div>
                    </form>
                    


                    @endif
                    
                    @if($flagreport==1)
                    <div class="row row-centered"><div class="col-xs-12 col-centered">
            <a href="home" role="button" class="btn btn-default col-xs-12">Сохранить отчет</a>
            </div></div>
            <div class="row row-centered">
            
                    <div class="alert alert-success col-xs-12 col-centered"><p>{{ $mes }}</p></div>
                    
                    
            </div>
                  <div class="row row-centered">  
            <div class="col-md-12 col-xs-12 col-sm-12">
            
            </div></div>
            <div id="fileuploader" class="fileuploader">Upload</div>
<script>
$(document).ready(function()
{
	$("#fileuploader").uploadFile({
	url:"{{ route('rewmysql') }}",
	multiple:false,
    dragDrop:false,
    statusBarWidth: "100%",
    acceptFiles:"image/*",
    
    
	fileName:"myfile",
	formData: {"name":"{{ $name }}","_token":"{{ csrf_token() }}"},
	maxFileSize:20000*20000,
    abortStr:"Не загружать",
	cancelStr:"Не загружено",
	doneStr:"Загружено",
	uploadErrorStr:"Ошибка",
	uploadStr:"Добавить фото"
	
	
	});
});
var csrftoken = $('meta[name=_token]').attr('content');
$.ajaxSetup({
    beforeSend: function (xhr, settings) {
        if (!/^(GET|HEAD|OPTIONS|TRACE)$/i.test(settings.type)) {
            xhr.setRequestHeader("X-CSRFToken", csrftoken)
        }
    }
});
</script>
            
                    @endif
                    
                    @if($flagreport==2)
                    <div class="alert alert-success"><p>{{ $mes }}</p></div>
                    
                    @endif
                    </div>
                               
            </div>
        </div>
    </div>
    
</div>

        
@endsection
