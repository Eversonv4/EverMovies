declare module '@/api/apiConfig' {
  const apiConfig: {
    baseUrl: string;
    apiKey: string;
    originalImage: (imgPath: string) => string;
    w500Image: (imgPath: string) => string
  };
  export default apiConfig;
}