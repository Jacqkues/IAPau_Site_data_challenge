import com.sun.net.httpserver.HttpExchange;
import com.sun.net.httpserver.HttpHandler;
import com.sun.net.httpserver.HttpServer;

import java.io.*;
import java.net.InetSocketAddress;
import java.nio.charset.StandardCharsets;
import java.util.concurrent.Executors;
import java.util.logging.Logger;
import java.util.HashMap;
import java.util.Map;


public class CodeAnalyzerAPI {
    private static final Logger LOGGER = Logger.getLogger(CodeAnalyzerAPI.class.getName());
    private static final int PORT = 8001;
    private static final String UPLOAD_URL = "/upload";

    public static void main(String[] args) {
        HttpServer server;
        try {
            server = HttpServer.create(new InetSocketAddress(PORT), 0);
            server.createContext(UPLOAD_URL, new UploadFormHandler());
            server.setExecutor(Executors.newCachedThreadPool());
            server.start();
            LOGGER.info("Server started on port " + PORT);
        } catch (IOException e) {
            LOGGER.severe("Error starting the server: " + e.getMessage());
        }
    }

    private static class UploadFormHandler implements HttpHandler {
        @Override
        public void handle(HttpExchange exchange) throws IOException {
            if ("GET".equalsIgnoreCase(exchange.getRequestMethod())) {
                displayUploadForm(exchange);
            } else if ("POST".equalsIgnoreCase(exchange.getRequestMethod())) {
                processUploadFile(exchange);
            } else {
                sendResponse(exchange, 405, "Method Not Allowed");
            }
        }

        private void sendResponse(HttpExchange exchange, int statusCode, String response) throws IOException {
            byte[] bytes = response.getBytes(StandardCharsets.UTF_8);

            exchange.getResponseHeaders().add("Access-Control-Allow-Origin", "*");
            exchange.getResponseHeaders().add("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
            exchange.getResponseHeaders().add("Access-Control-Allow-Headers", "Content-Type");

            exchange.sendResponseHeaders(statusCode, bytes.length);
            try (OutputStream outputStream = exchange.getResponseBody()) {
                outputStream.write(bytes);
            }
        }

        private void displayUploadForm(HttpExchange exchange) throws IOException {
            String response = "<html>\n" +
            "<head>\n" +
            "<title>Code Analyzer</title>\n" +
            "</head>\n" +
            "<body>\n" +
            "<h1>Code Analyzer</h1>\n" +
            "<form action='" + UPLOAD_URL + "' method='post' enctype='multipart/form-data'>\n" +
            "<label for='file'>Select a file:</label><br>\n" +
            "<input type='file' name='file'><br><br>\n" +
            "<input type='submit' value='Analyze'>\n" +
            "</form>\n" +
            "</body>\n" +
            "</html>";
            sendResponse(exchange, 200, response);
        }

        private void processUploadFile(HttpExchange exchange) throws IOException {
            String boundary = extractBoundary(exchange.getRequestHeaders().getFirst("Content-Type"));
            if (boundary == null) {
                sendResponse(exchange, 400, "Invalid request");
                return;
            }

            try (InputStream inputStream = exchange.getRequestBody();
                    BufferedReader reader = new BufferedReader(
                            new InputStreamReader(inputStream, StandardCharsets.UTF_8))) {
                String line;
                while ((line = reader.readLine()) != null) {
                    if (line.contains(boundary)) {
                        // Read until the end of the boundary
                        break;
                    }
                }

                // Read the file content
                StringBuilder fileContent = new StringBuilder();
                while ((line = reader.readLine()) != null) {
                    if (line.contains(boundary)) {
                        // Reached the next boundary, stop reading
                        break;
                    }
                    fileContent.append(line).append("\n");
                }

                // Analyze the code
                String code = fileContent.toString();
                String analysisResult = analyzeCode(code);

                // Display the analysis result
                sendResponse(exchange, 200, analysisResult);
            }
        }

        private String extractBoundary(String contentTypeHeader) {
            if (contentTypeHeader != null && contentTypeHeader.startsWith("multipart/form-data")) {
                String[] parts = contentTypeHeader.split(";");
                for (String part : parts) {
                    if (part.trim().startsWith("boundary=")) {
                        return part.trim().substring("boundary=".length());
                    }
                }
            }
            return null;
        }

        private String analyzeCode(String code) {
            int minFLines = countFunctionLines(code, 0);
            int maxFLines = countFunctionLines(code, 1);
            int moyFLines = countFunctionLines(code, 2);
            int countLines = countLines(code);
            int countFunctions = countFunctions(code);
            
            Map<String, Integer> informationMap = new HashMap<>();
        informationMap.put("minFLines", minFLines);
        informationMap.put("maxFLines", maxFLines);
        informationMap.put("moyFLines", moyFLines);
        informationMap.put("countLines", countLines);
        informationMap.put("countFunctions", countFunctions);

            StringBuilder jsonBuilder = new StringBuilder();
            jsonBuilder.append("{");

            boolean first = true;
        for (Map.Entry<String, Integer> entry : informationMap.entrySet()) {
            if (!first) {
                jsonBuilder.append(",");
            }
            jsonBuilder.append("\"").append(entry.getKey()).append("\":").append(entry.getValue());
            first = false;
        }

        jsonBuilder.append("}");

        // Affichage de la chaîne JSON résultante
        String jsonString = jsonBuilder.toString();
        return jsonString;
           /* return "Total de lignes du code : " + countLines(code) + "\n" +
                    "Total de fonctions : " + countFunctions(code) + "\n" +
                    "Nombre min de lignes dans une fonctions : " + minFLines + "\n" +
                    "Nombre max de lignes dans une fonctions : " + maxFLines + "\n" +
                    "Nombre moyen de lignes dans les fonctions : " + moyFLines + "\n";*/
        }

        public static int countLines(String code) {
            String[] lines = code.split("\n");
            int lineCount = 0;

            for (int i = 0; i < lines.length; i++) {
                if (isNotEmptyOrComment(lines[i])) {
                    lineCount++;
                }
            }
            return lineCount;
        }

        public static int countFunctions(String code) {
            String[] lines = code.split("\n");
            int fCount = 0;

            for (int i = 0; i < lines.length; i++) {
                if (lines[i].trim().startsWith("def")) {
                    fCount++;
                }
            }
            return fCount;
        }

        public static int countFunctionLines(String code, int mode) {
            String[] lines = code.split("\n");
            int currentFLines = 0; // Lignes max dans la fonction courante
            int fLines;
            int i = 0;

            switch (mode) {
                case 0:
                    fLines = Integer.MAX_VALUE;
                    while (i < lines.length) {
                        if (lines[i].trim().startsWith("def")) {
                            currentFLines = 1;
                            i++;
                            while (i < lines.length && !(lines[i].trim().startsWith("def"))) {
                                if (isNotEmptyOrComment(lines[i].trim())) {
                                    currentFLines++;
                                }
                                i++;
                            }
                            if (currentFLines > 0 && currentFLines < fLines) {
                                fLines = currentFLines;
                            }
                        } else {
                            i++;
                        }
                    }
                    break;
                case 1:
                    fLines = 0;
                    while (i < lines.length) {
                        if (lines[i].trim().startsWith("def")) {
                            currentFLines = 1;
                            i++;
                            while (i < lines.length && !(lines[i].trim().startsWith("def"))) {
                                if (isNotEmptyOrComment(lines[i].trim())) {
                                    currentFLines++;
                                }
                                i++;
                            }
                            if (currentFLines > 0 && currentFLines > fLines) {
                                fLines = currentFLines;
                            }
                        } else {
                            i++;
                        }
                    }
                    break;

                case 2:
                    fLines = 0;
                    int totalFLines = 0;
                    while (i < lines.length) {
                        if (lines[i].trim().startsWith("def")) {
                            currentFLines = 1;
                            i++;
                            while (i < lines.length && !(lines[i].trim().startsWith("def"))) {
                                if (isNotEmptyOrComment(lines[i].trim())) {
                                    currentFLines++;
                                }
                                i++;
                            }
                            totalFLines += currentFLines;
                        } else {
                            i++;
                        }
                    }
                    int nbFunction = countFunctions(code);
                    if (nbFunction > 0) {
                        fLines = totalFLines / nbFunction;
                    } else {
                        fLines = 0;
                    }

                    break;

                default:
                    fLines = -1;
                    break;
            }
            return fLines;
        }

        public static boolean isNotEmptyOrComment(String line) {
            if (line.trim().isEmpty() || line.trim().startsWith("#")) {
                return false;
            }
            return true;
        }
    }
}
