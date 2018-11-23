
function ParsTable() {
   /* var row = 1;
    var data = $('table tr:nth-child(' + row + ')').find('td:nth-child(2)').html();
    console.log(data);*/

    //Объект таблицы в DOM
    var table = $('#dynamic-table');

    //Объекты всех строк таблицы
    var rows = table.children().children();

    //Массив соответствующий строкам таблицы
    var arrayOfTrValues = [];


    //Перебор строк (DOM-элементы)
    for (var rowI = 0; rowI < rows.length; rowI++) {
        //Объект, соответсвующий содержимому одной строки
        var row = {};

        //Ячейки текущей строки (DOM-элемент)
        var tr = $(rows[rowI]).children();
        //console.log($(rows[rowI]).children());


        //Перебор ячеек (DOM-элементы)
        for (var trI = 1; trI < tr.length; trI++) {
            //Название класса текущей строки (DOM-элемент)
            var tdClass = $(tr[trI]).attr('class');

            //Запись значения
            row[tdClass] = $(tr[trI]).html();
            console.log($(tr[trI]).html());
        }

        //Добавление элемента в результат
        //arrayOfTrValues.push(row);
    }

    //Вывод результата
    //console.log(arrayOfTrValues);
    /*var table = document.getElementById('dynamic-table');

    //Объекты всех строк таблицы
    var rows =document.getElementById('dynamic-table').rows;
    //var rows = table.children[1];
    console.log(rows);

    //Массив соответствующий строкам таблицы
    var arrayOfTrValues = [];

    //Перебор строк (DOM-элементы)
    for (var rowI = 0; rowI < rows.length; rowI++) {
        //Объект, соответсвующий содержимому одной строки
        var row = {};

        //Ячейки текущей строки (DOM-элемент)
        var tr = rows[rowI].children;

        //Перебор ячеек (DOM-элементы)
        for (var trI = 0; trI < tr.length; trI++) {
            //Название класса текущей строки (DOM-элемент)
            //var tdClass = tr[trI].className;

            //Запись значения
            row[trI] = tr[trI].innerHTML;
        }

        //Добавление элемента в результат
        arrayOfTrValues.push(row);
    }

    //Вывод результата
    console.log(arrayOfTrValues[0][1]);*/

}
/*function ParsTable(tableID)  {
    var qty = [];
    var messureUnit = [];
    var price = [];
    var total = [];
    var table = x(tableID);
    var rowCount = table.rows.length;
    for (var i = 1; i < rowCount; i++) {
        messureUnit[i] = table.rows[i].cells[2].innerHTML;
        price[i] = table.rows[i].cells[3].innerHTML;
        price[i] = table.rows[i].cells[4].innerHTML;
        qty[i] = table.rows[i].cells[1].innerHTML;
    }
    var array = JSON.stringify(qty);
    $.ajax({
        type: "POST",
        data: { array1: array },
        url: "DataReceiver.php",
        dataType: 'json',
        success: function (response) {
            $('#resp').val(response);
        }
    });
}
*/

var DynamicTable = (function(GLOB) {
    var RID = 0;
    return function(tBody) {
        if (!(this instanceof arguments.callee)) {
            return new arguments.callee.apply(arguments);//конструктор
        }

        tBody.onclick = function(e) {
            var evt = e || GLOB.event,//события
                trg = evt.target || evt.srcElement;//ОБРАШЕНИЕ к вложенему елементу на котором было вызвано событеэ
            if (trg.className && trg.className.indexOf("add") !== -1) {
                _addRow(trg.parentNode.parentNode, tBody);//ФУнкция добавления строки
            } else if (trg.className && trg.className.indexOf("del") !== -1) {
                tBody.rows.length > 1 && _delRow(trg.parentNode.parentNode, tBody);//Функция удаления
            }
        };
        var el=document.getElementsByClassName("dynamicExample");
        var _rowTpl = el[0].cloneNode(true);//Получает первую строку и создайот ее точную копию
        _rowTpl.style.display='table-row';
        var _correctNames = function(row) {
            var elements = row.getElementsByTagName("*");//возвращает массив, содержащий ссылки на все элементы указанного типа, находящиеся в HTML-документе.
            for (var i = 0; i < elements.length; i += 1) {
                if (elements.item(i).name) {//Метод item возвращает текущий элемент
                    if (elements.item(i).type &&
                        elements.item(i).type === "text" &&
                        elements.item(i).className &&
                        elements.item(i).className.indexOf("glob") !== -1) {
                        elements.item(i).value = RID;
                    } else {
                        elements.item(i).name = RID + "[" + elements.item(i).name + "]";
                    }
                }
            }
            RID++;
            return row;
        };
        var _addRow = function(before, tBody) {
            var newNode = _correctNames(_rowTpl.cloneNode(true));
            newNode.style.display="bloc";
            tBody.insertBefore(newNode, before.nextSibling);// добавляет узел (element) в список дочерних элементов указанного родителя перед указанным узлом (element).
        };
        var _delRow = function(row, tBody) {
            tBody.removeChild(row);//Удаляет дочерний элемент из DOM. Возвращает удаленный элемент.
        };
        _correctNames(tBody.rows[0]);
    };
})(this);




//  new DynamicTable(document.getElementById("dynamic"));