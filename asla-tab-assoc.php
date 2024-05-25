<?php

	function estEnPromo( $produit ){
		
		if( $produit[ 'promotion' ] == 0 ){
			return FALSE ;
		}
		else {
			return TRUE ;
		}
	}
	
	function estUnPetitPrix( $produit , $petitPrix ){
		
		if( $produit[ 'prixUnit'] <= $petitPrix ){
			return TRUE ;
		}
		else {
			return FALSE ;
		}
	}

	function calculerPrixPromo( $produit ){
		
		return $produit[ 'prixUnit'] - ( $produit[ 'prixUnit'] * $produit[ 'promotion'] / 100 ) ;
	}
	
	function getProduitEnChaine( $produit ){
		
		$code = $produit[ 'code' ]  ;
		$nom = $produit[ 'nom' ]  ;
		$prixUnit = $produit[ 'prixUnit' ]  ;
		$promo = $produit[ 'promotion' ]  ;
		
		return "\n[$code] $nom\n\tPrix  : $prixUnit €\n\tPromo : $promo %\n" ;
	}
	
	
	// Exercice 1
	function visualiserProduits(){
		global $produits ;
		
		foreach( $produits as $unProduit ){
			echo getProduitEnChaine( $unProduit ) ;
		}
	}
	
	// Exercice 2
	function visualiserProduitsEnPromo(){
		global $produits ;
		
		foreach( $produits as $unProduit ){
			if( estEnPromo( $unProduit ) == TRUE ){
				// Votre code ici
				echo getProduitEnChaine( $unProduit ) ;
				echo "\tPrix promo : " , calculerPrixPromo( $unProduit ) , " €\n" ;
			}
		}
		
	}
	
	// Exercice 3
	function getPromoMax(){
		global $produits ;
		
		$promoMax = 0 ;
		
		foreach( $produits as $unProduit ){
			if( estEnPromo( $unProduit ) == TRUE ){
				if($unProduit[ 'promotion' ] > $promoMax){
					$promoMax = $unProduit[ 'promotion' ] ;
				}
			}
		}
		
		return $promoMax ;
	}
	
	// Exercice 4
	function getPromoMin(){
		global $produits ;

		$promoMax = getPromoMax() ;

		foreach( $produits as $unProduit ){
			if( estEnPromo( $unProduit ) == TRUE ){
				if($unProduit[ 'promotion' ] < $promoMax){
					$promoMin = $unProduit[ 'promotion' ] ;
					$promoMax = $unProduit[ 'promotion' ] ;
				}
			}
		}
		
		return $promoMin ;
	}
	
	// Exercice 5
	function calculerMoyennePromos(){
		global $produits ;
		
		$totalPromos = 0 ;
		$nbPromos = 0 ;
		
		foreach( $produits as $unProduit ){
			
			if( estEnPromo( $unProduit ) == TRUE ){
				$nbPromos = $nbPromos + 1 ;
				$promo = $unProduit[ 'promotion' ] ;
				$totalPromos = $totalPromos + $promo ;
			}
		}
		
		return $totalPromos / $nbPromos ;
	}
	
	// Exercice 6
	function getProduit( $code ){
		global $produits ;
		
		$leProduit = Array() ;
		$i = 0 ;
		
		while( $i < count( $produits ) && count( $leProduit ) == 0 ){
			if( $produits[ $i ][ 'code' ] == $code ){
				$leProduit = $produits[ $i ] ;
			}
			else {
				$i = $i + 1 ;
			}
		}
		
		return $leProduit ;
	}
	
	// Exercice 7
	function annulerToutesLesPromos(){
		global $produits ;
		
		for( $i = 0 ; $i < count( $produits ) ; $i = $i + 1 ){
			$produits[ $i ][ 'promotion' ] = 0 ;
		}
	}
	
	// Exercice 8
	function appliquerMemePromoTousProduits( $promo ){
		global $produits ;

		for( $i = 0 ; $i < count( $produits ) ; $i = $i + 1 ){
			$produits[ $i ][ 'promotion' ] = $promo ;
		}

	}
	
	// Fonction utilisée dans l'exercice 9
	function getIndiceProduit( $code ){
		global $produits ;
		
		$indice = -1 ;
		$i = 0 ;
		
		while( $i < count( $produits ) && $indice == -1 ){
			if( $produits[ $i ][ 'code' ]  == $code ){
				$indice = $i ;
			}
			else {
				$i = $i + 1 ;
			}
		}
		
		return $indice ;
	}
	
	
	// Exercice 9
	function appliquerPromoProduit( $code , $promo ){
		global $produits ;
		
		$ind = getIndiceProduit( $code ) ;
		
		if( $ind != -1 ){
			$produits[$ind]['promotion'] = $promo;
		}
		else{
			echo "Code invalide\n" ;
		}
	}
	
	
	# Fonction principale
	function mainTest(){
		
		global $produits ;
		
		$produits = Array(
				Array( 'code' => 178 , 'nom' => "Dentifrice à la fraise" , 'prixUnit' => 15 , 'promotion' => 10 ) ,
				Array( 'code' => 179 , 'nom' => "Dentifrice au sel marin" , 'prixUnit' => 8.9 , 'promotion' => 0 ) ,
				Array( 'code' => 181 , 'nom' => "Dentifrice au citron vert" , 'prixUnit' => 10.9 , 'promotion' => 5 ) ,
				Array( 'code' => 182 , 'nom' => "Dentifrice à l'orange" , 'prixUnit' => 12 , 'promotion' => 0 ) ,
				Array( 'code' => 201 , 'nom' => "Crème hydratante à l'huile d'avocat" , 'prixUnit' => 20.5 , 'promotion' => 0 ) ,
				Array( 'code' => 202 , 'nom' => "Crème hydratante à l'huile d'argan" , 'prixUnit' => 19.3 , 'promotion' => 20 ) ,
				Array( 'code' => 203 , 'nom' => "Crème hydratante à l'huile de coco" , 'prixUnit' => 17.3 , 'promotion' => 10 ) ,
				Array( 'code' => 204 , 'nom' => "Crème de nuit relaxante" , 'prixUnit' => 21.7 , 'promotion' => 50 ) ,
				Array( 'code' => 210 , 'nom' => "Crème de jour parfumée au jasmin" , 'prixUnit' => 37.5 , 'promotion' => 30 )
			) ;
		
		echo "----------------------------------\n" ;
		foreach( $produits as $produit ){
			print_r( $produit ) ;
		}
		echo "----------------------------------\n" ;
		
		
		// Exercice 1
		echo "\n1) Liste des produits :\n\n" ;
		visualiserProduits() ;
		
		
		// Exercice 2
		echo "\n2) Liste des produits en promo :\n\n" ;
		visualiserProduitsEnPromo() ;
	
		
		// Exercice 3
		echo "\n3) Promotion max :\n\n" ;
		echo getPromoMax() , " %\n" ;
		
		
		// Exercice 4
		echo "\n4) Promotion min :\n\n" ;
		echo getPromoMin() , " %\n" ;
	
		
		// Exercice 5
		echo "\n5) Moyenne des promotions :\n\n" ;
		echo calculerMoyennePromos() , " %\n" ;
	
	
		// Exercice 6
		echo "\n6) Recherche d'un produit par son code :\n\n" ;
		
		echo "Produit 179 :\n\t" ;
		$leProduit = getProduit( 179 ) ;
		if(in_array($leProduit , $produits)){
			echo getProduitEnChaine($leProduit) ;
		}
		else{
			echo "Produit inconnu" ;
		}
		print_r( $leProduit ) ;
		
		
		echo "Produit 318 :\n\t" ;
		$leProduit = getProduit( 318 ) ;
		if(in_array($leProduit , $produits)){
			echo getProduitEnChaine($leProduit) ;
		}
		else{
			echo "Produit inconnu\n" ;
		}
		print_r( $leProduit ) ;
		
		// Exercice 7
		echo "\n7) Annuler toutes les promotions :\n\n" ;
		echo visualiserProduits(annulerToutesLesPromos()) ;
		
		
		// Exercice 8
		echo "\n8) Appliquer une promotion de 10 % à tous les produits :\n\n" ;
		appliquerMemePromoTousProduits( 10 ) ;
		visualiserProduits() ;
		
		
		// Exercice 9
		echo "\n9) Appliquer une promotion de 30 % au produit 210 :\n\n" ;
		appliquerPromoProduit( 210 , 30 ) ;
		visualiserProduits() ;
		
	}
	
	# Programme Principal
	mainTest() ;

?>
