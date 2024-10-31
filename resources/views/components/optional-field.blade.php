@props(['name'])

<div class="js-{{$name}}-field sub-field">
    <label for="{{$name}}">{{$name}}</label>
    <div class="field-button-container">
        <div class="input-container">
            <input type="text" name="{{$name}}" value = "{{$slot}}"
            class="js-{{$name}}-input">
        </div>
        <div class="button-container">
            <button class="js-remove-but remove" type="button">-</button>
        </div>                                
    </div>                                    
</div>  