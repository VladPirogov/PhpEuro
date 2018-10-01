

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




new DynamicTable(document.getElementById("dynamic"));