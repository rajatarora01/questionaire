<html>
    <head>
        <link rel='stylesheet' type='text/css' href='../vinyasa/css/jqgrid/redmond/jquery-ui.css' />
        <link rel='stylesheet' type='text/css' href='../vinyasa/css/jqgrid/ui.jqgrid.css' />

        <script src="../vinyasa/js/jqgrid/jquery-1.11.0.min.js"></script>
        <script type='text/javascript' src='../vinyasa/js/jqgrid/jquery-ui.min.js'></script>        
        <script type='text/javascript' src='../vinyasa/js/jqgrid/i18n/grid.locale-en.js'></script>
        <script type='text/javascript' src='../vinyasa/js/jqgrid/jquery.jqGrid.min.js'></script>
        <script>
            $(document).ready(function () {
                $("#list_records").jqGrid({
                    url: "data.php",
                    datatype: "json",
                    //mtype: "GET",
                    colNames: ["Id", "Question", "Option 1", "Option 2", "Option 3", "Correct Option", "Action(s)", "q_title_img", "category"],
                    colModel: [
                        {name: "id", align: "right", classes: 'cvteste', editable: false, hidden: true},
                        {name: "q_title", classes: 'cvteste', editable: true},
                        {name: "option_1", classes: 'cvteste', editable: true},
                        {name: "option_2", classes: 'cvteste', editable: true},
                        {name: "option_3", classes: 'cvteste', editable: true},
                        {name: "option_4", classes: 'cvteste', editable: true},
                        {name: "act", index: "act", width: 130, sortable: false},
                        {name: "q_title_img", classes: 'cvteste', editable: false, formatter: imageFormatter},
                        {name: "category", index: "category", width: 200,
                            sortable: true,
                            align: 'center',
                            editable: true,
                            cellEdit: true,
                            edittype: 'select',
                            formatter: 'select',
                            editoptions: {value: "<?php
require('../classes/DAO.php');
$dao = DAOFactory::getDAO();
$dao->getAllCategories();
?>"},
                            editrules: {required: true}
                        }
                    ],
                    pager: "#perpage",
                    rowNum: 10,
                    rowList: [10, 20],
                    sortname: "q_title",
                    sortorder: "asc",
                    gridComplete: function () {
                        var ids = jQuery("#list_records").jqGrid('getDataIDs');
                        for (var i = 0; i < ids.length; i++) {
                            var cl = ids[i];
                            be = "<input style='height:22px;width:40px;' type='button' value='Edit' onclick=\"jQuery('#list_records').jqGrid('editRow','" + cl + "');\"  />";
                            se = "<input style='height:22px;width:40px;' type='button' value='Save' onclick=\"jQuery('#list_records').jqGrid('saveRow','" + cl + "');\"  />";
                            ce = "<input style='height:22px;width:50px;' type='button' value='Cancel' onclick=\"jQuery('#list_records').jqGrid('restoreRow','" + cl + "');\" />";
                            im = "<img id=im" + cl + "  width='50px' height='50px'><input class='hidden' id=fl" + cl + " type='file' onChange=\"var reader = new FileReader();reader.onload = function (e) {document.getElementById('im" + cl + "').src = e.target.result;};reader.readAsDataURL(this.files[0]);\">";
                            jQuery("#list_records").jqGrid('setRowData', ids[i], {act: im});
                        }
                    }
                    ,
                    editurl: "../classes/quiz_updt.php",
                    height: 'auto',
                    viewrecords: true,
                    gridview: true,
                    toolbar: [true, "top"],
                    caption: "Questions"
                }
                );
                jQuery("#list_records").jqGrid('navGrid', "#perpage", {edit: true, add: true, del: true}
                , {closeOnEscape: true, reloadAfterSubmit: true, modal: true}
                );
            }

            );
            function imageFormatter(cellvalue, options, rowObject) {
                // var num = '2';
                var num = rowObject[6];
//                        alert(rowObject);
                return ("<center><img src='data:image/jpeg;base64," + num + "' height='20px' width='20px' /></center>")
            }
            function getAllCategories() {
                var states = {"1": 'Alabama', "2": 'California', "3": 'Florida',
                    "4": 'Hawaii', "5": 'London', "6": 'Oxford'};

                return states;

            }
            $("#list_records tr").click(function () {
                var tr = $(this)[0];
                var trID = tr.id;
                alert("trID=" + trID);
            });
        </script>
    </head>
    <body>
        <table id="list_records"><tr><td></td></tr></table> 
        <div id="perpage"></div>
    </body>
</html>