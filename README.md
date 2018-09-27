ditribuidosG21


Api productos, agrego los que hice, más los que estaban: 

get /producto/{id}                    # Retorna un producto dado un id
get /producto                         # Retorna todos los productos 
get /productTypes/{typeId}/productos  # Retorna todos los productos de un producttype id
get /productos/buscar?nombre=algo     # Busca productos por nombre 
get /productTypes                     # Retorna todos los producttypes
get /productTypes/{id}                # Retorna un producttype dado un id
