function apiModifyTable(originalData,id,response){
    angular.forEach(originalData, function (item,key) {
    	// console.log(item.id_produk +'/'+id);
        if(item.id_produk == id){
            originalData[key] = response;
        }
    });
    return originalData;
}