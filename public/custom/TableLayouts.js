class TableLayouts {
    
    //labels, values is array and func as a dict
    constructor (labels, values, id, parent='body', func={"View": true}, alert=null) {
        this.labels = labels;
        this.values = values;
        this.id = id;
        this.className = 'management-table';
        this.funcAdd = func["Add"];
        this.funcView = func["View"];
        this.funcUpdate = func["Update"];
        this.funcDelete = func["Delete"];
        this.parent = parent;
        this.alert = alert;
        this.tableName = 'tenbangdung';
    }
    
    //Create table in HTML DOM
    Init() {
        //check labels and values
        if (this.labels.length != this.values[0].length + 1)
            throw new Exception('Labels and Values are not matched.');

        // var formObj = document.createElement('form');
        // formObj.setAttribute('method', 'post');
        // formObj.setAttribute('action', '"{{route("update")}}"')
        // var tdTableName = document.createElement('input');
        // tdTableName.setAttribute('type', 'text');
        // tdTableName.setAttribute('value', this.tableName);
        // tdTableName.style.display = 'none';
        // formObj.appendChild(tdTableName);

        const parent = this.parent; 
        const table = document.createElement('table');
        //Class name for access table element
        table.classList.add(this.className);
        table.setAttribute('id', this.id);
        table.style.width = '99%';
        table.style.marginLeft = '0.5%';
        table.style.marginRight = '0.5%';
        table.style.marginTop = '0.5%';
        table.style.marginBottom = '0.5%';
        var tbody = document.createElement('tbody');
        var trHead = document.createElement('tr');
        var tdHeight = 0;
        //create th columns
        this.labels.forEach(label=> {
            var th = document.createElement('th');
            th.style.paddingTop = th.style.paddingBottom = '5px';
            th.style.backgroundColor = 'rgb(50,144,119)';
            th.style.color = 'white';
            th.appendChild(document.createTextNode(label.toString()));
            trHead.appendChild(th);
        });
        tbody.appendChild(trHead);
        //create information row below
        if (this.values.length > 0)
            {
                this.values.forEach(value=> {
                    var tr = document.createElement('tr');
                    tr.setAttribute('id', 'row-position-id-' + value[0]);
                    value.forEach(valueChild => {
                        var td = document.createElement('td');
                        td.style.paddingLeft = '2px';
                        td.style.paddingRight = '2px';
                        switch(TableLayouts.CheckDataType(valueChild.toString())) {
                            case -1:  // as a Date obj
                               td.classList.add('table-input-type-datetime');
                                break;
                            case 0:   // as a string
                                td.classList.add('table-input-type-string');
                                break;
                            case 1:   //a number
                                td.classList.add('table-input-type-number');
                                break;
                        }
                        td.appendChild(document.createTextNode(valueChild.toString()));
                        tr.appendChild(td);
                        tdHeight = tr.height;
                    });
                    var tdFunction = document.createElement('td');
                    tdFunction.style.width = '10%';
                    tdFunction.style.paddingLeft = '2px';
                    tdFunction.style.paddingRight = '2px';
                    tdFunction.classList.add("td-function");
                    //show function
                    if (this.funcView) {
                        var container = document.createElement('div');
                        container.setAttribute('style', 'display: inline-block');
                        container.innerHTML += '<button class="btn btn-outline-secondary border-0" id="view-id-'+ value[0].toString() + '">' + '<i class="fa-solid fa-up-right-and-down-left-from-center"></i>' + '</button>';
                        tdFunction.appendChild(container);
                    }
                    if (this.funcUpdate) {
                        var container = document.createElement('div');
                        container.setAttribute('style', 'display: inline-block');
                        container.innerHTML += '<button class="btn btn-outline-secondary border-0" id="update-id-'+ value[0].toString() + '">' + '<i class="fa-solid fa-pen-to-square"></i>' + '</button>';
                        tdFunction.appendChild(container);
                    }
                    if (this.funcDelete) {
                        var container = document.createElement('div');
                        container.setAttribute('style', 'display: inline-block');
                        container.innerHTML += '<button class="btn btn-outline-secondary border-0" id="delete-id-'+ value[0].toString() + '">' + '<i class="fa-solid fa-trash"></i>' + '</button>';
                        tdFunction.appendChild(container);
                    }
                    //append row to table
                    tr.appendChild(tdFunction);
                    tbody.appendChild(tr);
                });
            }
        const rowNumber = 20;
        if (this.values.length < rowNumber) {
             //full fill with empty rows
            for (var row = rowNumber - this.values.length; row > 0; row--) {
                var tr = document.createElement('tr');
                if (row == rowNumber - this.values.length) {
                    tr.setAttribute('id', 'add-new-row');
                }
                for (var column = 0; column < this.labels.length - 1; column++) {
                    var td = document.createElement('td');
                    tr.appendChild(td);
                }
                var tdFunction = document.createElement('td');
                tdFunction.style.width = '10%';
                tdFunction.style.paddingLeft = '2px';
                tdFunction.style.paddingRight = '2px';
                tdFunction.classList.add("td-function");
                //show function
                if (this.funcView) {
                    var container = document.createElement('div');
                    container.setAttribute('style', 'display: inline-block');
                    container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-up-right-and-down-left-from-center"></i>' + '</button>';
                    container.style.visibility = 'hidden';
                    tdFunction.appendChild(container);
                }
                if (this.funcUpdate) {
                    var container = document.createElement('div');
                    container.setAttribute('style', 'display: inline-block');
                    container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-pen-to-square"></i>' + '</button>';
                    container.style.visibility = 'hidden';
                    tdFunction.appendChild(container);
                }
                if (this.funcDelete) {
                    var container = document.createElement('div');
                    container.setAttribute('style', 'display: inline-block');
                    container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-trash"></i>' + '</button>';
                    container.style.visibility = 'hidden';
                    tdFunction.appendChild(container);
                }
                
                tr.appendChild(tdFunction);
                tbody.appendChild(tr);
            }
        }
        table.append(tbody);
        // formObj.appendChild(table);
        parent.appendChild(table);
    }

    Add(tableName) {
        //process interface
            //last child
            var obj = document.getElementById('add-new-row');
            if (obj) {
                var sample = document.getElementById(this.id).querySelector('tr:nth-child(2)');
                var newNode = sample.cloneNode(true);
                newNode.setAttribute('class', "");
                newNode.setAttribute('id', 'row-position-id-new');
                var formObj = document.createElement('form');
                for (var count = 0; count < newNode.childElementCount - 1; count++) {
                    var tdNewNode = document.createElement('input');
                    tdNewNode.style.width = '100%'; 
                    switch (TableLayouts.CheckDataType(newNode.childNodes[count].textContent.toString())) {
                        case -1:  // as a Date obj
                            tdNewNode.setAttribute('type', 'datetime-local');
                            tdNewNode.setAttribute('name', 'input-value-' + count);
                            tdNewNode.setAttribute('id', 'input-value-' + count);
                            break;
                        case 0:   // as a string
                            tdNewNode.setAttribute('type', 'text');
                            tdNewNode.setAttribute('name', 'input-value-' + count);
                            tdNewNode.setAttribute('id', 'input-value-' + count);
                            break;
                        case 1:   //a number
                            tdNewNode.setAttribute('type', 'number');
                            tdNewNode.setAttribute('name', 'input-value-' + count);
                            tdNewNode.setAttribute('id', 'input-value-' + count);
                            break;
                    }
                    tdNewNode.setAttribute('value', '');
                    newNode.childNodes[count].setAttribute('style', 'width: ' + sample.childNodes[count].offsetWidth + 'px !important');
                    newNode.childNodes[count].removeChild(newNode.childNodes[count].firstChild);
                    newNode.childNodes[count].appendChild(tdNewNode);
                }
                var tdFunction = newNode.lastChild;
                tdFunction.childNodes.forEach(func => {
                    func.classList.add('hidden');
                });
                var container = document.createElement('div');
                container.setAttribute('style', 'display: inline-block');
                container.innerHTML += '<button class="btn btn-outline-secondary border-0" onclick="{SendUpdateRes(\'\/home\/add\', \'' + tableName + '\', 1) ;TableLayouts.ShowFunction(\'' + 'new' + '\', ' + this.amountFunction() + ');}">Add</button>';
                tdFunction.appendChild(container);
            //newNode.setAttribute('id', 'row-position-id-' + value_id);
            obj.replaceWith(newNode);
            } //have null child row
            else { //all of row filled
                var newRow = document.createElement('tr');
                var sample = document.getElementById(this.id).querySelector('tr:nth-child(2)');
                for (var count = 0; count < sample.childElementCount - 1; count++) {
                    var tdNode = document.createElement('td');
                    var tdNewNode = document.createElement('input');
                    tdNode.setAttribute('style', 'width: ' + sample.childNodes[count].offsetWidth + 'px !important'); 
                    switch (TableLayouts.CheckDataType(sample.childNodes[count].textContent.toString())) {
                        case -1:  // as a Date obj
                            tdNewNode.setAttribute('type', 'datetime-local');
                            break;
                        case 0:   // as a string
                            tdNewNode.setAttribute('type', 'text');
                            break;
                        case 1:   //a number
                            tdNewNode.setAttribute('type', 'number');
                            break;
                    }
                    tdNewNode.setAttribute('value', '');
                    tdNode.appendChild(tdNewNode);
                    newRow.appendChild(tdNode);
                }
                document.getElementById(this.id).appendChild(newRow);
            }
        //process with server
    }

    View(id) {
        //process interface
        var table = document.getElementById(this.id);
        var td = table.insertRow(id + 1);
        td.appendChild(); //content in here
        //process with server
    }

    Update(tableName, id) {
        //process interface
        var tdArray = document.getElementById('row-position-id-' + id).childNodes;
        for (var count = 0; count < tdArray.length - 1; count++) {
            let valueIn = tdArray[count].textContent;
            var tdNewNodeParent = document.createElement('td');
            var tdNewNode = document.createElement('input');
            tdNewNode.style.width = '100%';
            tdNewNode.style.textAlign = 'center';
            tdNewNode.style.border = '0';
            switch (TableLayouts.CheckDataTypedocument.getElementById('row-position-id-1').childNodes[0].textContent) {
                case -1:  // as a Date obj
                    tdNewNode.setAttribute('type', 'datetime-local');
                    tdNewNode.setAttribute('name', 'input-value-' + count);
                    tdNewNode.setAttribute('id', 'input-value-' + count);
                    var valueSplit = valueIn.split(" ");
                    tdNewNode.setAttribute('value', valueSplit[0] + 'T' + valueSplit[1]);
                    break;
                case 0:   // as a string
                    tdNewNode.setAttribute('type', 'text');
                    tdNewNode.setAttribute('name', 'input-value-' + count);
                    tdNewNode.setAttribute('id', 'input-value-' + count);
                    tdNewNode.setAttribute('value', valueIn);
                    break;
                case 1:   //a number
                    tdNewNode.setAttribute('type', 'number');
                    tdNewNode.setAttribute('name', 'input-value-' + count);
                    tdNewNode.setAttribute('id', 'input-value-' + count);
                    tdNewNode.setAttribute('value', valueIn);
                    break;
            }
            // tdNewNodeParent.style.display = 'inline-block';
            tdNewNodeParent.setAttribute('style', 'width: ' + tdArray[count].offsetWidth + 'px !important'); 
            tdNewNodeParent.appendChild(tdNewNode);    
            tdArray[count].replaceWith(tdNewNodeParent);
        }
        var tdFunction = document.getElementById('row-position-id-' + id).lastChild;
        tdFunction.childNodes.forEach(func => {
            func.classList.add('hidden');
        });
        var container = document.createElement('div');
        container.setAttribute('style', 'display: inline-block');
        container.innerHTML += '<button class="btn btn-outline-secondary border-0" onclick="{SendUpdateRes(\'\/home\/update\', ' + '\'' + tableName + '\', ' + id + '); TableLayouts.ShowFunction(' + id + ', ' + this.amountFunction() + ');}">Done</button>';
        tdFunction.appendChild(container);
        //process with server   
    }

    Delete(id) {
        //process interface
        var tr = document.getElementById('row-position-id-' + id);
        tr.style.border = '0';
        tr.hidden = true;
        var tableTemp = document.getElementById(this.id);
        var tr = document.createElement('tr');
        // if delete has situation for new row
        for (var column = 0; column < this.labels.length - 1; column++) {
            var td = document.createElement('td');
            tr.appendChild(td);
        }
        var tdFunction = document.createElement('td');
        tdFunction.style.width = '10%';
        tdFunction.style.paddingLeft = '2px';
        tdFunction.style.paddingRight = '2px';
        tdFunction.classList.add("td-function");
        //show function
        if (this.funcView) {
            var container = document.createElement('div');
            container.setAttribute('style', 'display: inline-block');
            container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-up-right-and-down-left-from-center"></i>' + '</button>';
            container.style.visibility = 'hidden';
            tdFunction.appendChild(container);
        }
        if (this.funcUpdate) {
            var container = document.createElement('div');
            container.setAttribute('style', 'display: inline-block');
            container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-pen-to-square"></i>' + '</button>';
            container.style.visibility = 'hidden';
            tdFunction.appendChild(container);
        }
        if (this.funcDelete) {
            var container = document.createElement('div');
            container.setAttribute('style', 'display: inline-block');
            container.innerHTML += '<button class="btn btn-outline-secondary border-0" disabled>' + '<i class="fa-solid fa-trash"></i>' + '</button>';
            container.style.visibility = 'hidden';
            tdFunction.appendChild(container);
        }
        
        tr.appendChild(tdFunction);
        var tbody = tableTemp.firstChild.appendChild(tr);
        tableTemp.append(tbody);
        //process with server
    }

    static CheckDataType(str) {           //-1 datetime, 0 string, 1 number
        if (this.isDate(str)) {
            return -1;
        }
        else if (Number.isNaN(parseFloat(str))) {
            return 0;
        }
        else {
            return 1;
        }
    }
    amountFunction() {
        var amount = 0;
        var funcCheck = [this.funcView, this.funcUpdate, this.funcDelete];
        funcCheck.forEach(value => {
            if (value) {
                amount++;
            }
        });
        return amount;
    }
    static ShowFunction(id, amountFunc) {
        var tdFunction = document.getElementById('row-position-id-' + id).lastChild;
        for (var count = 0; count <= amountFunc - 1; count++) {
            tdFunction.childNodes[count].classList.remove('hidden');
        }
        tdFunction.lastChild.classList.add('hidden');

        //
        var tdValue = document.getElementById('row-position-id-' + id).childNodes;
        for (var count = 0; count <= tdValue.length - 2; count++) {
            var valueInInput = tdValue[count].firstChild.value;
            if (this.isDate(valueInInput)) {
                var datetimeValue = valueInInput.split("T");
                valueInInput = datetimeValue[0] + ' ' + datetimeValue[1];
            }
            tdValue[count].firstChild.replaceWith(document.createTextNode(valueInInput));    
        }
    }

    static isDate(sDate) {  
        var tempArray = sDate.split(" ");
        if(tempArray.length != 2 || ((new Date(sDate)).toString() == 'Invalid Date' && (new Date(tempArray[0] + 'T' + tempArray[1])).toString() == 'Invalid Date')) return false; 
        var tryDate = new Date(sDate);
        return (tryDate && tryDate.toString() != "NaN" && tryDate != "Invalid Date");  
      }
}