let postForm, addTechBut, addFeatureBut,
    techStackContainer, featuresContainer, techField, featureField;

document.addEventListener("DOMContentLoaded", () =>
{
    postForm = document.querySelector(".js-post-form");
    techStackContainer = document.querySelector(".js-tech-stack-container");
    techField = document.querySelector(".js-tech-field");
    featuresContainer = document.querySelector(".js-features-container");
    featureField = document.querySelector(".js-feature-field");
    addTechBut = document.querySelector(".js-add-tech-but");
    addFeatureBut = document.querySelector(".js-add-feature-but");

    addRemoveListener(techField);
    addRemoveListener(featureField);

    addTechBut.addEventListener("click", () =>
    {
        makeNewField(addTechBut, techStackContainer, techField);        
    })
    addFeatureBut.addEventListener("click", () =>
    {
        makeNewField(addFeatureBut, featuresContainer, featureField);
    })

    function makeNewField(but, container, field)
    {
        const newField = field.cloneNode(true);
        const inp = newField.querySelector('input');
        inp.value = "";
        addRemoveListener(newField);
        container.appendChild(newField);
    }

    postForm.addEventListener("submit", (e) =>
    {
        e.preventDefault();
        const form = e.target;
        const techStackJson = convertFieldsToJson(form, ".js-tech-input", "tech_stack");
        const featuresJson = convertFieldsToJson(form, ".js-feature-input", "features");
        
        form.appendChild(techStackJson);
        form.appendChild(featuresJson);
        form.submit();
    });

    function convertFieldsToJson(form, inputSelector, inputName)
    {
        const inputs = form.querySelectorAll(inputSelector);
        const arr = Array.from(inputs).map((i) => i.value);
        console.log("arr ", arr);
        const jsonField = document.createElement('input');
        jsonField.type = 'hidden';
        jsonField.name = inputName;
        jsonField.value = JSON.stringify(arr);

        for(let i = 0; i < inputs.length; ++i)
        {
            inputs[i].remove();
        }

        return jsonField;
    }

    function addRemoveListener(field)
    {
        const removeBut = field.querySelector('.js-remove-but');
        removeBut.addEventListener('click', () =>
        {
            field.remove();
        });
    }
});