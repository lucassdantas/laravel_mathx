# ➗ MathX – Gerador de Exercícios Matemáticos

Projeto feito com **Laravel**, desenvolvido em **2 dias** como exercício de prática. O sistema permite gerar listas de exercícios matemáticos personalizados com base nas operações e intervalos definidos pelo usuário.

## 📌 Sobre o Projeto

O **MathX** é um gerador de exercícios matemáticos com as seguintes funcionalidades principais:

- Geração de exercícios com as 4 operações básicas: adição, subtração, multiplicação e divisão
- Intervalo numérico personalizável
- Número de exercícios configurável (de 5 a 50)
- Impressão direta dos exercícios com soluções
- Exportação para arquivo `.txt`

## 🔢 Funcionalidades

- Validação dinâmica para garantir ao menos uma operação selecionada
- IDs dos exercícios numerados e ordenados
- Soluções geradas automaticamente
- Resultados formatados para divisão com casas decimais
- Exportação via `Content-Disposition` para download
- Impressão em layout limpo via HTML

## 📄 Views

- `home`: formulário para configurar e gerar os exercícios
- `operations`: exibe os exercícios gerados

## 🚥 Rotas

- `/`: Página inicial com o formulário
- `/generate-exercises`: Gera os exercícios (POST)
- `/print-exercises`: Visualização pronta para impressão (GET)
- `/export-exercises`: Exporta os exercícios em `.txt` (GET)

## 🛠️ Validações

- Pelo menos uma operação deve ser marcada
- Os dois números devem ser inteiros entre 0 e 999
- O número de exercícios deve estar entre 5 e 50
- Os divisores nunca são zero para evitar divisão por zero

## 🧠 Lógica

- As operações são escolhidas aleatoriamente com base nas marcadas
- A divisão é arredondada para duas casas decimais
- Os dados são armazenados em sessão para reutilização (impressão e exportação)

## 👨‍💻 Autor

**Lucas Dantas**  
[https://devdantas.com.br](https://devdantas.com.br)
