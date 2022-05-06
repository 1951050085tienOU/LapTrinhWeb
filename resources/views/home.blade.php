@extends('homelayouts')

@section('head')
<script>

    var table;
    var labels;  //array
    var values = new Array();   //2D array
    <?php
        if ($_SERVER['REQUEST_METHOD'] == 'GET')
        {
            echo "
                let params = new URLSearchParams((new URL(window.location.href)).search);
                var tableIndex = params.get('tab-selection');
            ";
        }
        else {
            echo "var tableIndex = '{$tabSelection}';";
        }
    ?>
    
    var tableNameForManager = new Array('hopdong', 'thongtincanho', 'nhankhau', 'thongtinsuco');
    var tableNameForAccountant = new Array('hoadon_kh', 'hoadon_dt');

    window.onload = function() {
        @if (auth()->user()->Role == 'Manager') 
        switch (tableIndex) {
            case '1':
                var liNodes = document.querySelectorAll('li.nav-item');
                liNodes.forEach(li => {
                    li.classList.remove('tab-selected');
                });
                liNodes[0].classList.add('tab-selected');
                break;
            case '2':
                AddSearchBarAndAddButton(table, 2);
                var liNodes = document.querySelectorAll('li.nav-item');
                liNodes.forEach(li => {
                    li.classList.remove('tab-selected');
                });
                liNodes[1].classList.add('tab-selected');

                // add labels
                labels = new Array('ID', 'Store Path', 'Date', 'Apartment No.', 'Created By', 'Function');
                // add values
                var count = 0;
                @foreach ($table_results as $value) {
                    values.push(new Array(
                        '{{$value->id}}',
                        '{{$value->path}}',
                        '{{$value->date}}',
                        '{{$value->apartmentNo}}',
                        '{{$value->createdBy}}'
                    ));
                    count++;
                }
                @endforeach
                
                if (values.length == 0) {
                    var notice = document.createTextNode("No items for viewing.")
                    document.getElementsByClassName('content')[0].appendChild(notice);
                    break;
                }
                table =  new TableLayouts(labels, values, 'contracts-table', document.getElementsByClassName('content')[0], {"View": true, "Update": true, "Delete": true, "Add": true});
                table.Init()
                break;
            case '3':
                AddSearchBarAndAddButton(table, 3);
                var liNodes = document.querySelectorAll('li.nav-item');
                liNodes.forEach(li => {
                    li.classList.remove('tab-selected');
                });
                liNodes[2].classList.add('tab-selected');

                // add labels
                labels = new Array('ID', 'Description', 'Rooms', 'Upstairs', 'Restroom', 'In Area', 'Created By', 'Function');
                // add values
                var count = 0;
                @foreach ($table_results as $value) {
                    values.push(new Array(
                        '{{$value->id}}',
                        '{{$value->description}}',
                        '{{$value->rooms}}',
                        '{{$value->upstairs}}',
                        '{{$value->restroom}}',
                        '{{$value->inArea}}',
                        '{{$value->createdBy}}'
                    ));
                    count++;
                }
                @endforeach
                
                if (values.length == 0) {
                    var notice = document.createTextNode("No items for viewing.")
                    document.getElementsByClassName('content')[0].appendChild(notice);
                    break;
                }
                table =  new TableLayouts(labels, values, 'apartment-table', document.getElementsByClassName('content')[0], {"View": true, "Update": false, "Delete": false, "Add": true});
                table.Init()
                break;
            case '4':
                AddSearchBarAndAddButton(table, 4);
                var liNodes = document.querySelectorAll('li.nav-item');
                liNodes.forEach(li => {
                    li.classList.remove('tab-selected');
                });
                liNodes[3].classList.add('tab-selected');

                // add labels
                labels = new Array('ID', 'Name', 'Identity Number', 'Ap. Owner', 'Function');
                // add values
                var count = 0;
                @foreach ($table_results as $value) {
                    values.push(new Array(
                        '{{$value->id}}',
                        '{{$value->lastname}}' + ' ' + '{{$value->firstname}}',
                        '{{$value->identityNumber}}',
                        '{{$value->ownerIndex}}',
                    ));
                    count++;
                }
                @endforeach
                
                if (values.length == 0) {
                    var notice = document.createTextNode("No items for viewing.")
                    document.getElementsByClassName('content')[0].appendChild(notice);
                    break;
                }
                table =  new TableLayouts(labels, values, 'individuals-table', document.getElementsByClassName('content')[0], {"View": true, "Update": true, "Delete": true, "Add": true}, ['1', '3']);
                table.Init()
                break;
            case '5':
                AddSearchBarAndAddButton(table, 5);
                var liNodes = document.querySelectorAll('li.nav-item');
                liNodes.forEach(li => {
                    li.classList.remove('tab-selected');
                });
                liNodes[4].classList.add('tab-selected');

                // add labels
                labels = new Array('ID', 'Description', 'Date', 'Apartment No.', 'Created By', 'Function');
                // add values
                var count = 0;
                @foreach ($table_results as $value) {
                    values.push(new Array(
                        '{{$value->id}}',
                        '{{$value->description}}',
                        '{{$value->date}}',
                        '{{$value->apartmentNo}}',
                        '{{$value->createdBy}}'
                    ));
                    count++;
                }
                @endforeach
                
                if (values.length == 0) {
                    var notice = document.createTextNode("No items for viewing.")
                    document.getElementsByClassName('content')[0].appendChild(notice);
                    break;
                }
                table =  new TableLayouts(labels, values, 'report-table', document.getElementsByClassName('content')[0], {"View": true, "Update": false, "Delete": false, "Add": true}, ['1']);
                table.Init()
                break;
            @else
            switch (tableIndex) {
                case '1':
                    var liNodes = document.querySelectorAll('li.nav-item');
                    liNodes.forEach(li => {
                        li.classList.remove('tab-selected');
                    });
                    liNodes[0].classList.add('tab-selected');
                    break;
                case '2':
                    var liNodes = document.querySelectorAll('li.nav-item');
                    liNodes.forEach(li => {
                        li.classList.remove('tab-selected');
                    });
                    liNodes[1].classList.add('tab-selected');
                    break;
                case '3':
                    AddSearchBarAndAddButton(table, 3);
                    var liNodes = document.querySelectorAll('li.nav-item');
                    liNodes.forEach(li => {
                        li.classList.remove('tab-selected');
                    });
                    liNodes[2].classList.add('tab-selected');

                    // add labels
                    labels = new Array('ID', 'Description', "Date", 'Store Path', 'Who Paid', 'Created By', 'Function');
                    // add values
                    var count = 0;
                    @foreach ($table_results as $value) {
                        values.push(new Array(
                            '{{$value->id}}',
                            '{{$value->description}}',
                            '{{$value->createdDate}}',
                            '{{$value->path}}',
                            '{{$value->whoPay}}',
                            '{{$value->createdBy}}'
                        ));
                        count++;
                    }
                    @endforeach
                    
                    if (values.length == 0) {
                        var notice = document.createTextNode("No items for viewing.")
                        document.getElementsByClassName('content')[0].appendChild(notice);
                        break;
                    }
                    table =  new TableLayouts(labels, values, 'bills-customer-table', document.getElementsByClassName('content')[0], {"View": true, "Update": true, "Delete": true, "Add": true});
                    table.Init()
                    break;
                case '4':
                    AddSearchBarAndAddButton(table, 4);
                    var liNodes = document.querySelectorAll('li.nav-item');
                    liNodes.forEach(li => {
                        li.classList.remove('tab-selected');
                    });
                    liNodes[3].classList.add('tab-selected');

                    // add labels
                    labels = new Array('ID', 'Description', 'Date', 'Store Path', 'Who Paid', 'Created By', 'Function');
                    // add values
                    var count = 0;
                    @foreach ($table_results as $value) {
                        values.push(new Array(
                            '{{$value->id}}',
                            '{{$value->description}}',
                            '{{$value->createdDate}}',
                            '{{$value->path}}',
                            '{{$value->whoPay}}',
                            '{{$value->createdBy}}'
                        ));
                        count++;
                    }
                    @endforeach
                    
                    if (values.length == 0) {
                        var notice = document.createTextNode("No items for viewing.")
                        document.getElementsByClassName('content')[0].appendChild(notice);
                        break;
                    }
                    table =  new TableLayouts(labels, values, 'bills-partner-table', document.getElementsByClassName('content')[0], {"View": true, "Update": true, "Delete": true, "Add": true});
                    table.Init()
                    break;
            @endif
        }

        //Update Delete button
        @if (auth()->user()->Role == "Manager"))
            var arrayUpdateDeleteFunc = ['2', '4'];
        @else var arrayUpdateDeleteFunc = ['3', '4'];
        @endif
        tdFunctions = document.getElementsByClassName('td-function');
        if (tdFunctions && arrayUpdateDeleteFunc.includes(tableIndex)) {
            for (var count = 0; count < tdFunctions.length; count++) {
                var obj = tdFunctions[count].lastChild.firstChild;
                try {
                    var id = parseInt(obj.getAttribute('id').substring(obj.getAttribute('id').length - 1));
                    obj.setAttribute('onclick', 'SendUpdateRes(\'\/home\/delete\', "' + 
                        @if (auth()->user()->Role == "Manager")
                            tableNameForManager[tableIndex - 2]
                        @else tableNameForAccountant[tableIndex - 3]
                        @endif
                        + '", ' + id + '); table.Delete(' + id + ');');    
                } catch (exeptions) {
                    continue;
                }
            };
        }

        //Update Edit Function
        tdFunctions = document.getElementsByClassName('td-function');
        @if (auth()->user()->Role == "Manager"))
            var arrayUpdateEditFunc = ['2', '4'];
        @else var arrayUpdateEditFunc = ['3', '4'];
        @endif
        if (tdFunctions && arrayUpdateEditFunc.includes(tableIndex)) {
            for (var count = 0; count < tdFunctions.length; count++) {
                var obj = tdFunctions[count].childNodes[1].firstChild;
                try {
                    var id = parseInt(obj.getAttribute('id').substring(obj.getAttribute('id').length - 1));
                    obj.setAttribute('onclick', 'table.Update("' + 
                        @if (auth()->user()->Role == "Manager")
                            tableNameForManager[tableIndex - 2]
                        @else tableNameForAccountant[tableIndex - 3]
                        @endif + '", ' + id + ');');
                    obj.setAttribute('type', 'button');    
                } catch (exeptions) {
                    continue;
                }
            };
        }
        
        //Update Add Function
        tdAdd = document.getElementById('add-button');
        tdAdd.setAttribute('onclick', 'table.Add(\''+ 
                        @if (auth()->user()->Role == "Manager")
                            tableNameForManager[tableIndex - 2]
                        @else tableNameForAccountant[tableIndex - 3]
                        @endif +'\')');
    }

    function AddSearchBarAndAddButton(table, tableIndex) {
        var div = document.createElement('div');
        div.style.display = 'inline-block';
        div.setAttribute('id', 'top-of-table-bar');
        div.classList.add('col-md-12');
        var inputElement = document.createElement('input');
        inputElement.setAttribute('id', 'search-bar');
        inputElement.setAttribute('name', 'search-bar');
        inputElement.setAttribute('type', 'text');
        inputElement.setAttribute('value', '{{$contentSearch}}');
        inputElement.classList.add('col-md-2');
        var searchButton = document.createElement('button');
        searchButton.innerHTML += '<i class="fa-solid fa-magnifying-glass"></i>';
        searchButton.setAttribute('type', 'submit');
        searchButton.setAttribute('id', 'search-button');
        searchButton.style.width = "35px";
        searchButton.style.margin = "5px 5px 0 5px";
        searchButton.classList.add('button-table-bar');
        var addButton = document.createElement('button');
        addButton.innerHTML += '<i class="fa-solid fa-plus"></i>';
        addButton.setAttribute('type', 'button');
        addButton.setAttribute('id', 'add-button');
        addButton.style.width = "60px";
        addButton.style.margin = "5px 5px 0 5px";
        addButton.classList.add('button-table-bar');
        var formObject = document.createElement('form');
        formObject.setAttribute('action', '/home');
        formObject.setAttribute('method', 'post');
        formObject.innerHTML += '@csrf';
        var inputTableName = document.createElement('input');
        inputTableName.setAttribute('id', 'table-name');
        inputTableName.setAttribute('name', 'table-name');
        inputTableName.setAttribute('value', 
                        @if (auth()->user()->Role == "Manager")
                            tableNameForManager[tableIndex - 2]
                        @else tableNameForAccountant[tableIndex - 3]
                        @endif);
        inputTableName.style.visibility = 'hidden';
        inputTableName.style.position = 'absolute';
        var inputIndex = document.createElement('input');
        inputIndex.setAttribute('id', 'tab-selection');
        inputIndex.setAttribute('name', 'tab-selection');
        inputIndex.setAttribute('value', tableIndex);
        inputIndex.style.visibility = 'hidden';
        inputIndex.style.position = 'absolute';
        formObject.appendChild(searchButton);
        formObject.appendChild(inputElement);
        formObject.appendChild(inputTableName);
        formObject.appendChild(inputIndex);
        div.appendChild(formObject);
        div.appendChild(addButton);
        document.getElementsByClassName('content')[0].appendChild(div);
    }
    

    // var table = new TableLayouts();
    
    //Complete Function
    function Delete(id) {
        //process with interface
        table.Delete(id);
    }

    //Addition Function
    function SendUpdateRes(api, tableName, id) {
        const csrfToken = document.head.querySelector("[name~=csrf-token][content]").content;
        var tableNameUse = tableName;
        var vals = [];
        var count = 0;
        while (count <= 10) {
            var element = document.getElementById('input-value-' + count);
            if (element == null) {
                break;
            }
            if (element.value == "") {
                vals.push('null');
            } 
            else {
                vals.push(element.value);
            }
            count++;
        }

        fetch(api,
        {
            headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json; charset=UTF-8',
            "X-CSRF-Token": csrfToken
            },
            method: "POST",
            body: JSON.stringify({
                table: tableNameUse,
                val0: id,
                val1: vals[1],
                val2: vals[2],
                val3: vals[3],
                val4: vals[4],
                val5: vals[5],
                val6: vals[6],
                val7: vals[7],
                val8: vals[8],
                val9: vals[9],
                val10: vals[10]
            }), 
            data:{
                _token: "{{ csrf_token() }}"
            }
        })
        .then(function(res){ console.log(res) });
    }
</script>
@endsection
@section('content')
    
@endsection