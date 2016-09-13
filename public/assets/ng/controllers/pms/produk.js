app.controller('produkController', function($scope, $http, API_URL) {
	$scope.libraryTemp = {};
  	$scope.totalItemsTemp = {};
  	$scope.totalItems = 0;

    //retrieve employees listing from API
    // $http.get(API_URL + "pms/produk")
    //     .success(function(response) {
    //     	// console.log(response);
    //         $scope.produks = response.data;
    //     });
    getResultsPage(1);

    //show modal form
	$scope.toggle = function(modalstate, id){
    	$scope.modalstate = modalstate; //untuk memberi nilai ke ng-click="save(modalstate, id_produk)". jadi nanti setiap elemen ng-... otomatis ke set nilainya
    	// console.log(id);

    	switch(modalstate){
    		case 'add' :
    			$scope.form_title = 'Tambah Data';
    			$scope.produk = null;
    		break;
    		case 'edit' :
    			$scope.form_title = 'Edit Data';
    			$scope.id_produk = id;
    			$http.get(API_URL + "pms/produk/" + id)
    				.success(function(response){
    					$scope.produk = response;
    				});
    		break;
    		default:
    		break;
    	}

    	$('#myModal').modal('show');
    }

    $scope.save = function(modalstate, id){
    	var _url = API_URL + 'pms/produk';
    	var _method = (modalstate === 'edit') ? 'PUT' : 'POST';

    	if(modalstate ==='edit') _url += '/'+id;

    	$http({
    		'method' 	: _method,
    		'url'		: _url,
    		'data'		: $.param($scope.produk),
    		'headers'	: {'Content-Type': 'application/x-www-form-urlencoded'}
    	}).success(function(response){
    		console.log(response);
    		// console.log('modal : '+response.id_produk);
    		if(modalstate === 'edit') {
    			$scope.produks = apiModifyTable($scope.produks, response.id_produk, response);
    		}
    		else {
    			$scope.produks.push(response);
    		}
    			
    		$('#myModal').modal('hide');
    		$.gritter.add({
	            title: 'Application',
	            text: 'Data Berhasil Disimpan',
	            fade_out_speed: 5000
	        });
    		// location.reload();
    	})
    	// .error(function(data, status, headers, config){
     //        console.log(data);
     //        console.log(status);
     //        console.log(headers);
     //        console.log(config);
     //    });
        .error(function(error){
    	// }).error(function(jqXhr, json, errorThrown){
            // error : function(jqXhr, json, errorThrown) { 
    		// console.log(status);

            // var errors = jqXhr.responseJSON;
            // alert('Error : '.error);
            // if(status == 422)
            // var errorsHtml= '';
            // $.each( errors, function( key, value ) {
            //     console.log('key = '+key+' -> '+value);
            //     // isian = $('form').find('#'+key);
            //     // isian.parent().parent().addClass('has-error');
            //     // isian.siblings().removeClass('hidden');
            //     // isian.siblings().children().text(value[0]);
            //     // //errorsHtml += '<li>' + value[0] + '</li>'; 
            // });

    		// $.gritter.add({
	     //        title: 'Application',
	     //        text: 'Data Gagal Disimpan',
	     //        fade_out_speed: 5000
	     //    });
    		// alert('Simpan Gagal');
    	});

    }

    $scope.confirmDelete = function(_produks, _index){
    	var isConfirmDelete = confirm('Anda yakin mau menghapus data ini?');
    	if(isConfirmDelete){
    		$http({
    			'method'	: 'DELETE',
    			'url'		: API_URL+'pms/produk/'+_produks.id_produk 
    		}).success(function(response){
				$scope.produks.splice(_index,1);
	    		$.gritter.add({
		            title: 'Application',
		            text: 'Data Berhasil Dihapus',
		            fade_out_speed: 5000
		        });
    		}).error(function(response){
	    		console.log(response);
	    		$.gritter.add({
		            title: 'Application',
		            text: 'Data Gagal Dihapus',
		            fade_out_speed: 5000
		        });

	    		// alert('Hapus Gagal');
    		});
    	}
    }

function getResultsPage(pageNumber) {
	// console.log($scope.libraryTemp);
    if(! $.isEmptyObject($scope.libraryTemp)){
		$http({
			'method'	: 'GET',
			'url'		: API_URL+'pms/produk?search='+$scope.searchText+'&page='+pageNumber 
		}).success(function(response){
			// console.log(response);
			$scope.produks 		= response.data;
            $scope.totalItems 	= response.total;
		}).error(function(response){
    		console.log(response);
          // dataFactory.httpRequest('/items?search='+$scope.searchText+'&page='+pageNumber).then(function(data) {
          //   $scope.data = data.data;
            // $scope.totalItems = data.total;
      	});
    }else{
		$http({
			'method'	: 'GET',
			'url'		: API_URL+'pms/produk?page='+pageNumber 
		}).success(function(response){

			$scope.produks 		= response.data;
	        $scope.totalItems 	= response.total;
        // dataFactory.httpRequest('/items?page='+pageNumber).then(function(data) {
        //   $scope.data = data.data;
        //   $scope.totalItems = data.total;
        // });
    	}).error(function(response){
    		console.log(response);
        });
    }
  }
  $scope.searchDB = function(){
      if($scope.searchText.length >= 3){
      		// console.log($scope.libraryTemp);
      		if($.isEmptyObject($scope.libraryTemp)){
              	$scope.libraryTemp = $scope.produks;
        //       	$scope.totalItemsTemp = $scope.totalItems;
              	$scope.produks = {};
       		}
          getResultsPage(1);
      }else{
          	if(!$.isEmptyObject($scope.libraryTemp)){
              	$scope.produks = $scope.libraryTemp ;
              	$scope.totalItems = $scope.totalItemsTemp;
              	$scope.libraryTemp = {};
          	}
      }
  }

  $scope.pageChanged = function(newPage) {
    getResultsPage(newPage);
  };
});