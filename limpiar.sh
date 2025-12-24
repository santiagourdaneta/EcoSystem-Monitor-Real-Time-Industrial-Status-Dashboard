#!/bin/bash
echo "🧹 Empezando limpieza profunda del código..."

# Limpiar Go
echo "-> Ordenando Go..."
cd api-gateway-go && gofmt -w . && cd ..

# Limpiar TypeScript 
if command -v npx &> /dev/null
then
    echo "-> Puliendo Frontend..."
    cd frontend-ts && npx prettier --write . && cd ..
fi

echo "✨ ¡Código reluciente y listo para la batalla!"