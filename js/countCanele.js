var defaultValue = 25;
var value = 0;
var valueCan = 25;
var valueFurnace = 0;
var costAmelioration = 0;

const result = document.getElementById("result");
const verif = document.getElementById('plusOneFurnace');
const resultNumber = document.getElementById('resultNumber');
const resultFurnace = document.getElementById('resultFurnace');
const resultTitle = document.getElementById('resultTitle');

function count(answer)
{
    if (answer == "upCanele")
    {
        value ++;

        if (valueCan != 0)
        {
            valueCan --;

            if(valueCan < 0)
            {
                valueCan *= -1;
                valueCan -= valueCan;
            }
        }

        if (valueCan <= 0) verif.disabled = false;
        else verif.disabled = true;
    }
    else if (answer == "upFurnace")
    {
        valueFurnace++;
        
        value -= defaultValue;
        calculator();

        if (value < valueCan)
        {
            valueCan = valueCan - value;
            verif.disabled = true;
        }
        else
        {
            valueCan -= valueCan;
            verif.disabled = false;
        }
    }

    elementItems(result, value, "Canelé");
    elementItems(resultNumber, valueCan, "Canelé");
    elementItems(resultFurnace, valueFurnace, "Four");
}

function elementItems(id, value, string)
{
    if (value <= 1) id.innerHTML = value + " " + string;
    else id.innerHTML = value + " " + string + "s";
}

function calculator()
{
    costAmelioration = Math.floor((defaultValue * 0.6) / 2);
    valueCan = defaultValue + costAmelioration;
    defaultValue = valueCan;
}

setInterval(function(){
    if(valueFurnace < 0) return;

    value += valueFurnace;
    valueCan -= valueFurnace;

    if(valueCan < 0)
    {
        valueCan *= -1;
        valueCan -= valueCan;
    }

    elementItems(result, value, "Canelé");
    elementItems(resultNumber, valueCan, "Canelé");

    if (valueCan <= 0) verif.disabled = false;
    else verif.disabled = true;
}, 1000);