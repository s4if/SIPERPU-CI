/* 
 * The MIT License
 *
 * Copyright 2014 s4if.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

$(document).ready(function() {
    $.fn.datepicker.defaults.format = "yyyy/mm/dd";
    //$('#data_table').dataTable();
} );

function pilih_semua()
{
	// mengecek Banyak checkbox di dalam form
	jumKomponen = $("input:checkbox").length;
	
	// myForm[0] merupakan checkbox induk untuk centang semua data
	if(document.myForm[0].checked === false)
	{
		//jika status checked(false) maka akan checked(true) semuanya
		for(x = 1; x <= jumKomponen ; x++ )
		{
			if(document.myForm[x].type === "checkbox") document.myForm[x].checked = false;
		}
	}
	else 
	{
		//jika status checked(true) maka akan checked(false) semuanya
		for(x = 1; x <= jumKomponen ; x++ )
		{
			if(document.myForm[x].type === "checkbox") document.myForm[x].checked = true;
		}
	}
}
function konfirmasi()
{
	// jika checked lebih dari satu maka di exsekusi
	if($("input:checked").length > 0)
	{
		if(confirm('apakah anda yakin menghapus ?') === true)
		{
			return true;  
		} else {
			return false;
		}
	} else {
		alert("Anda Belum ada mencentang.");
		return false;
	}
}