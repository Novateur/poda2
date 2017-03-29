        function assign_to_printer(packs,name,price,orderno,itemid){
            //alert(packs+" "+name+" "+price+" "+orderno);
			$('#packs').val(packs);
			$('#name').val(name);
			$('#price').val(price);
			$('#orderno').val(orderno);
			$('#itemid').val(itemid);
			$('#printer_modal').openModal();
        }
		function upload_design(id)
		{
			$('#design_itemid').val(id);
			$('#my_modal').openModal();
		}
        $('#design_upload_form').submit(function(e){
            e.preventDefault();
            var file1,printers;
			file1 = $('#file1').val();
			
			if(file1=="")
			{
				document.getElementById("file1").style.border="1px solid red";
			}				
			else
			{
				$.ajax({
					url:"handler/upload_design.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="inserted")
						{
							$('#file1').val("");
							$('#desc').val("");
							$('#my_modal').closeModal();
							location.reload(true);
						}
						else
						{
							$('#my_modal').closeModal();
							alert(data);
						}
					}

				})
			}
        })        
		$('#assign_printer_form').submit(function(e){
            e.preventDefault();
			var state,city,printers;
			state = $('#state').val();
			city = $('#city').val();
			printers = $('#printers').val();
			
			if(state=="" || city=="" || printers=="")
			{
				if(state=="")
				{	
					document.getElementById("state").style.border="1px solid red";
				}
				if(city=="")
				{
					document.getElementById("city").style.border="1px solid red";
				}
				if(printers=="")
				{
					document.getElementById("printers").style.border="1px solid red";
				}
			}
			else
			{
				$.ajax({
					url:"handler/assign_printer.php",
					type:"POST",
					data: new FormData(this),
					cache:false,
					contentType:false,
					processData:false,
					success:function(data)
					{
						if(data=="inserted")
						{
							$('#printer_modal').closeModal();
							location.reload(true);
						}
						else
						{
							$('#printer_modal').closeModal();
							$('#response_msg').html(data);
						}
					}

				})
			}
        })
			function get_cities_drop(val)
			{
				if(val=="")
				{
					$('#city').html("<option value=''>--Choose city--</option>");
				}
				else
				{
					$.post("handler/get_cities.php",{state:val},function(response){
						$('#city').html(response);
					})
				}
			}
			function get_printers(val)
			{
				if(val=="")
				{
					$('#printers').html("<option value=''>--Choose city--</option>");
				}
				else
				{
					var state = $('#state').val();
					$.post("handler/get_printers.php",{city:val,state:state},function(response){
						$('#printers').html(response);
					})
				}
			}
			function all_designs(item)
			{
				$.post("handler/get_designs.php",{item:item},function(response){
					$('#paste_designs').html(response);
				})
			}
			function get_designs(item)
			{
				all_designs(item);
				$('#design_modal').openModal();

			}
			function force_download(file)
			{
				$.post("handler/download.php",{file:file},function(response){
					alert(response);
				});
			}
			function delete_design(id,item)
			{
				//alert(id+" "+item);
				if(confirm("Do you really want to delete this design")==true)
				{
					$.post("handler/delete_design.php",{id:id},function(response){

						if(response=="deleted")
						{
							//alert(item);
							all_designs(item);
						}
						else
						{
							alert(response);
						}
					})
				}
			}
			function remove_as_assigned(id)
			{
				$.post("handler/delete_order.php",{id:id},function(response){
					if(response=="removed")
					{
						location.reload(true);
					}
					else
					{
						$('#response_msg').html("Sorry,we could not unassgin the printer");
					}
				})
			}
			function edit_description(paste_id,val,id,item)
			{
				//alert(paste_id+" "+val);
				$(paste_id).html("<textarea rows'7' onblur=\"cancel_edit('"+paste_id+"','"+val+"',"+item+","+id+")\" onkeyup=\"submit_edit(event,this.value,"+id+","+item+")\">"+val+"</textarea>");
			}
			function submit_edit(e,val,id,item)
			{
				//alert(e.keyCode);
				if(e.keyCode==13)
				{
					
					$.post("handler/update_description.php",{val:val,id:id},function(response){
						if(response=="updated")
						{
							all_designs(item);
						}
						else
						{
							$('#design_response').html("Sorry,we could not update your record");
						}
					})
				}
			}
			function cancel_edit(paste_id,val,item,id)
			{
					$.post("handler/update_description.php",{val:val,id:id},function(response){
						if(response=="updated")
						{
							all_designs(item);
						}
						else
						{
							$('#design_response').html("Sorry,we could not cancel your update");
						}
					})
			}
			function fetch_locations(id)
			{
				$.post("handler/get_locations.php",{id:id},function(response){
					$('#paste_location').html(response);
					$('#view_location_modal').openModal();
				})
			}
			function get_printers_view()
			{
				$.get("handler/get_printers_admin.php?page=1",function(response){
					location.hash=1;
					$('#paste_printers').html(response);
				})
			}
			function delete_printer(id,page)
			{
				$('#paste_btn').html("<button type='button' class='waves-effect waves-light btn' onclick=\"cont_del_printer("+id+",'"+page+"')\">OK</button>");
				$('#delete_modal').openModal();
			}
			function block_printer(id,page)
			{
				$.post("handler/block_printer.php",{id:id},function(response){
					//alert(response);
					if(response=="blocked")
					{
						if(page=="search")
						{
							do_printer_search()
						}
						else
						{
							//go back to the current page
							handle_pagination(page);
						}
					}
				})
			}			
			function unblock_printer(id,page)
			{
				$.post("handler/unblock_printer.php",{id:id},function(response){
					//alert(response);
					if(response=="unblocked")
					{
						if(page=="search")
						{
							do_printer_search();
						}
						else
						{
							//go back to the current page
							handle_pagination(page);
						}
					}
				})
			}
			function cont_del_printer(id,page)
			{
				$.post("handler/delete_printer.php",{id:id},function(response){
					if(response=="deleted")
					{
						$('#delete_modal').closeModal();
						//Materialize.toast("Printer deleted successfully",5000);
						if(page=="search")
						{
							do_printer_search();
						}
						else
						{
							handle_pagination(page);
						}
					}
					else
					{
						$('#delete_modal').closeModal();
						Materialize.toast("Sorry we could not delete the printer",5000);
					}
				})
			}
			function paginate_printer(page)
			{
				$(window).bind('hashchange', function(event) {
					event.preventDefault();
					var page = location.hash.substring(1);
					handle_pagination(page);
				});
			}
			function handle_pagination(page)
			{
				$.get("handler/get_printers_admin.php?page="+page,function(response){
					$('#paste_printers').html(response);
				})
			}			
			function paginate_state(page)
			{
				$(window).bind('hashchange', function(event) {
					event.preventDefault();
					var page = location.hash.substring(1);
					handle_pagination_state(page);
				});
			}
			function handle_pagination_state(page)
			{
				$.get("handler/get_states.php?page="+page,function(response){
					$('#paste_states').html(response);
				})
			}
			function do_printer_search()
			{
				var search = $('#search').val();
				if(search=="")
				{
					document.getElementById("search").style.border="1px solid red";
				}
				else
				{
					$.post("handler/search_printer.php",{term:search},function(response){
						$('#paste_printers').html(response);
					})
				}
			}
			function get_states()
			{
				$.get("handler/get_states.php?page=1",function(response){
					$('#paste_states').html(response);
				})
			}			
			function get_cities()
			{
				$.get("handler/get_cities_admin.php?page=1",function(response){
					$('#paste_cities').html(response);
				})
			}
			function delete_state(id,page)
			{
				$('#paste_btn').html("<button type='button' class='waves-effect waves-light btn' onclick=\"cont_del_state("+id+","+page+")\">OK</button>");
				$('#delete_modal').openModal();
			}
			function cont_del_state(id,page)
			{
				$.post("handler/delete_states.php",{id:id},function(response){
					if(response=="deleted")
					{
						$('#delete_modal').closeModal();
						//Materialize.toast("Printer deleted successfully",5000);
						handle_pagination_state(page);
					}
					else
					{
						$('#delete_modal').closeModal();
						Materialize.toast("Sorry we could not delete the printer",5000);
					}
				})
			}
			function update_check(val)
			{
				var favorite=[];
				$.each($("input[name='states[]']:checked"),function(){
					favorite.push($(this).val());
				});
				if(favorite.length>0)
				{
					//alert("my favorite sports are:"+favorite.join(","));
					$('#delete_btn').show('fast');
					$('#cancel_btn').show('fast');
				}
				else
				{
					$('#delete_btn').hide('fast');
					$('#cancel_btn').hide('fast');
				}
			}			
			function update_check_cities(val)
			{
				var favorite=[];
				$.each($("input[name='cities[]']:checked"),function(){
					favorite.push($(this).val());
				});
				if(favorite.length>0)
				{
					//alert("my favorite sports are:"+favorite.join(","));
					$('#delete_btn').show('fast');
				}
				else
				{
					$('#delete_btn').hide('fast');
				}
			}
			function man(id)
			{
				if(id.checked) 
				{
					$('input:checkbox').prop('checked',true);
					$('#delete_btn').show('fast');
				}
				else
				{
					$('input:checkbox').removeAttr('checked');
					$('#delete_btn').hide('fast');
				}
			}
			function multi_del(page)
			{
				$('#multi_del_modal').openModal();
				$('#paste_btn_multi').html("<button type='button' class='waves-effect waves-light btn' onclick=\"cont_multi_del("+page+")\">OK</button>");
			}
			function cont_multi_del(page)
			{
				$.ajax
					({
						url:"handler/multi_del_states.php",
						type:"POST",
						data:$('#ma_multi_del').serialize(),
						success:function(response)
						{
							//alert();
							if(response=="deleted")
							{
								$('#multi_del_modal').closeModal();
								handle_pagination_state(page);
							}
							else
							{
								$('#multi_del_modal').closeModal();
								alert(response);
								//Materialize.toast("Sorry we could not delete the selected states",5000);
							}
						},
						error:function(error)
						{
							alert(error);
						}
					});
			}			
			function multi_del_cities(page)
			{
				$('#multi_del_modal').openModal();
				$('#paste_btn_multi').html("<button type='button' class='waves-effect waves-light btn' onclick=\"cont_multi_del_cities("+page+")\">OK</button>");
			}
			function cont_multi_del_cities(page)
			{
				$.ajax
					({
						url:"handler/multi_del_cities.php",
						type:"POST",
						data:$('#ma_multi_del').serialize(),
						success:function(response)
						{
							//alert();
							if(response=="deleted")
							{
								$('#multi_del_modal').closeModal();
								handle_pagination_city(page);
							}
							else
							{
								$('#multi_del_modal').closeModal();
								Materialize.toast("Sorry we could not delete the selected cities",5000);
							}
						},
						error:function(error)
						{
							alert(error);
						}
					});
			}
			function paginate_city(page)
			{
				$(window).bind('hashchange', function(event) {
					event.preventDefault();
					var page = location.hash.substring(1);
					handle_pagination_city(page);
				});
			}
			function handle_pagination_city(page)
			{
				$.get("handler/get_cities_admin.php?page="+page,function(response){
					$('#paste_cities').html(response);
				})
			}
			function delete_city(id,page)
			{
				$('#paste_btn').html("<button type='button' class='waves-effect waves-light btn' onclick=\"cont_del_city("+id+","+page+")\">OK</button>");
				$('#delete_modal').openModal();
			}
			function cont_del_city(id,page)
			{
				$.post("handler/delete_cities.php",{id:id},function(response){
					if(response=="deleted")
					{
						$('#delete_modal').closeModal();
						handle_pagination_city(page);
					}
					else
					{
						$('#delete_modal').closeModal();
						//alert(response);
						Materialize.toast("Sorry we could not delete the city",5000);
					}
				})
			}
			function get_assigned_orders_printer()
			{
				$.get("handler/get_orders.php?page=1",function(response){
					location.hash=1;
					$('#paste_assigned_orders').html(response);
				})
			}
			function all_designs_printer(item)
			{
				$.post("handler/get_designs_printer.php",{item:item},function(response){
					$('#paste_designs').html(response);
				})
			}
			function get_designs_printer(item)
			{
				all_designs_printer(item);
				$('#design_modal').openModal();

			}
			function paginate_assigned_orders(page)
			{
				$(window).bind('hashchange', function(event) {
					event.preventDefault();
					var page = location.hash.substring(1);
					handle_paginate_assigned_orders(page);
				});
			}
			function handle_paginate_assigned_orders(page)
			{
				$.get("handler/get_orders.php?page="+page,function(response){
					$('#paste_assigned_orders').html(response);
				})
			}
			function update_progress(id,page)
			{
				$('#assigned_id').val(id);
				$('#assigned_page').val(page);
				$('#update_modal').openModal();
			}
			$('#update_form').submit(function(e){
				e.preventDefault();
				var progress = $('#progress').val();
				var page = $('#assigned_page').val();
				if(progress=="")
				{
					document.getElementById("progress").style.border="1px solid red";
				}
				else
				{
					$.ajax({
						url:"handler/update_progress.php",
						type:"POST",
						data: new FormData(this),
						cache:false,
						contentType:false,
						processData:false,
						success:function(data)
						{
							if(data=="updated")
							{
								$('#update_modal').closeModal();
								handle_paginate_assigned_orders(page);
							}
							else
							{
								$('#response_msg').html("Error: We could not add the city");
							}
						}
					})
				}
			})
		function validate_form()
		{
			var current_pass,new_pass,con_new_pass;
			current_pass = $('#current_pass').val();
			new_pass = $('#new_pass').val();
			con_new_pass = $('#con_new_pass').val();
			if(current_pass=="" || new_pass=="" || con_new_pass=="")
			{
				if(current_pass=="")
				{
					document.getElementById("current_pass").style.border="1px solid red";
				}				
				if(new_pass=="")
				{
					document.getElementById("new_pass").style.border="1px solid red";
				}				
				if(con_new_pass=="")
				{
					document.getElementById("con_new_pass").style.border="1px solid red";
				}
			}
			else
			{
				if(new_pass == con_new_pass)
				{
					document.getElementById("myForm").submit();
				}
				else
				{
					Materialize.toast("Password mismatched",5000);
				}
			}
		}


