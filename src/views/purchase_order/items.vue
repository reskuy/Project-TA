<template>
  <div class="dashboard-container">
    <div class="button_group">
      <a
        class="button_s my_file el-button button_s el-button--primary el-button--small"
      >
        <input type="file" class="my_input" @change="importExcel" id="upload" />Import
      </a>
    </div>
     <v-data-table
    dense
    :headers="tableColumn"
    :items="dataArr"
    sort-by="kode"
    class="elevation-1"
    />
  </div>
</template>
<script>
import xlsx from "xlsx";
export default {
  name: 'Dashboard',
  data() {
    return {
      dataArr: [], 
      tableColumn: [], 
      tableLoading: false ,
      headers: [
          {
          text: 'prop0',
          align: 'left',
          value: 'prop0',
        },
        { text: 'Pelanggan', value: 'prop1' ,align: 'left',width:'150'},
        { text: 'Data', value: 'prop2' ,align: 'left',width:'150'},
      ],
    };
  },
  methods: {
    getHeader(sheet) {
      const XLSX = xlsx;
      const headers = [];
      const range = XLSX.utils.decode_range(sheet["!ref"]); 
      let C;
      /* Get cell value start in the first row */
      const R = range.s.r; //Line / / column C
      let i = 0;
      for (C = range.s.c; C <= range.e.c; ++C) {
        var cell =
          sheet[
            XLSX.utils.encode_cell({ c: C, r: R })
          ]; /* Get the cell value based on the address  find the cell in the first row */
        var hdr = "UNKNOWN" + C; // replace with your desired default
        // XLSX.utils.format_cell Generate cell text value
        if (cell && cell.t) hdr = XLSX.utils.format_cell(cell);
        if(hdr.indexOf('UNKNOWN') > -1){
          if(!i) {
            hdr = '__EMPTY';
          }else {
            hdr = '__EMPTY_' + i;
          }
          i++;
        }
        headers.push(hdr);
      }
      return headers;
    },
    /**
     * Import table
     */
     importExcel(e) {
      const files = e.target.files;
      console.log(files);
      if (!files.length) {
        return ;
      } else if (!/\.(xls|xlsx)$/.test(files[0].name.toLowerCase())) {
        return alert("The upload format is incorrect. Please upload xls or xlsx format");
      }
      const fileReader = new FileReader();
      fileReader.onload = ev => {
        try {
          const data = ev.target.result;
          const XLSX = xlsx;
          const workbook = XLSX.read(data, {
            type: "binary"
          });
          const wsname = workbook.SheetNames[0]; // Take the first sheet，wb.SheetNames[0] :Take the name of the first sheet in the sheets
          const ws = XLSX.utils.sheet_to_json(workbook.Sheets[wsname]); // Generate JSON table content，wb.Sheets[Sheet名]    Get the data of the first sheet
          const excellist = []; // Clear received data
          // Edit data
          for (var i = 0; i < ws.length; i++) {
            excellist.push(ws[i]);
          }
          console.log("Read results", excellist); // At this point, you get an array containing objects that need to be processed
          // Get header2-1
          const a = workbook.Sheets[workbook.SheetNames[0]];
          const headers = this.getHeader(a);
          console.log('headers', headers);
           this.setTable(headers, excellist);
          // Get header2-2
        } catch (e) {
          return alert("Read failure!");
        }
      };
      fileReader.readAsBinaryString(files[0]);
      var input = document.getElementById("upload");
      input.value = "";
    },
    setTable(headers, excellist) {
      const tableTitleData = []; // Store table header data
      const tableMapTitle = {}; // Set table content for Chinese and English
      headers.forEach((_, i) => {
        tableMapTitle[_] = "prop" + i;
        tableTitleData.push({
          text: _,
          value: "prop" + i,
        });
      });
      console.log("tableTitleData", tableTitleData);
      // Mapping table content attribute name is English
      const newTableData = [];
      excellist.forEach(_ => {
        const newObj = {};
        Object.keys(_).forEach(key => {
          newObj[tableMapTitle[key]] = _[key];
        });
        newTableData.push(newObj);
      });
      console.log('newTableData',newTableData);
      this.tableColumn = tableTitleData;
      this.dataArr = newTableData;
    },
    
  }
  
}

</script>

<style lang="scss" scoped>
// Button style
.button_group {
  .button_s {
    width: 78px;
    margin: 5px 10px 5px 5px;
  }
  .button_m {
    width: 100px;
    margin: 5px 10px 5px 5px;
  }
  .my_file {
    position: relative;
    .my_input {
      position: absolute;
      opacity: 0;
      width: 80px;
      height: 30px;
      top: 0;
      left: 0;
    }
  }
}
// Button style
</style>