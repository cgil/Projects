class CodeNode {
  public:
    CodeNode* next;
    byte *code;
    char *info;
    

    CodeNode() {}

};


class CodesList {
  private:
    int numCodes;
    CodeNode* rootNode;
    byte* resetCode;
    boolean first;
    boolean codesEqual(byte code1[6], byte code2[6]);
    void recursiveRelease(CodeNode* _node);
  public:
    boolean addCode(byte _code[6], char _info[100]);
    void printCodes();
    void init();
    void releaseList();
    CodeNode* findNodeByCode(byte* code);
    CodeNode* removeNodeByCode(byte* code);

};

void CodesList::init() {
  numCodes = 0;
  rootNode = NULL;
  first = false;
  //init the reset card id
  byte tempCode[6] = {0x45,0x0,0xBE,0x7A,0x58};
  resetCode = tempCode;
}

boolean CodesList::codesEqual(byte code1[6], byte code2[6]) {
  for (int i = 0; i < 6; i++) {
    if (code1[i] != code2[i]) return false;
  }
  return true;
}

CodeNode* CodesList::findNodeByCode(byte* codeIn) {
  CodeNode* cur = rootNode;
  while (cur != NULL) {
    if (codesEqual(cur->code, codeIn)) {
      return cur;
    }
    else {
      cur = cur->next;
    }
  }
    
    return NULL;
}

CodeNode* CodesList::removeNodeByCode(byte* codeIn) {
  CodeNode* prev = NULL;
  CodeNode* cur = rootNode;
  while (cur != NULL) {
    if (codesEqual(cur->code, codeIn)) {
      prev->next = cur->next;
      return cur;
    }
    else {
      prev = cur;
      cur = cur->next;
    }
  }
    
    return false;
}

void CodesList::releaseList() {
  recursiveRelease(rootNode);
  free(rootNode);
  rootNode = NULL;
}

void CodesList::recursiveRelease(CodeNode* _node) {
  if (_node->next != NULL) {
    recursiveRelease(_node->next);
    free(_node->next);
  }
  free(_node->code);
  free(_node->info);
}

//returns true if the code added, false else
boolean CodesList::addCode(byte _code[6], char _info[100]) {
  if (_code[5] == 217) {
    //if the reset card is read
    releaseList();
    return true;
  }
  if (findNodeByCode(_code) != NULL) {
    //if the code is already in the list
    return false;
  }
  else {
    if (rootNode == NULL) {
      //root not initialized
      rootNode = new CodeNode();
      rootNode->next = NULL;
      rootNode->code = new byte;
      rootNode->info = new char;
      for (int i = 0; i < 6; i++) {
        rootNode->code[i] = _code[i];
      }
      rootNode->info = _info;
    }
    else {
      //root has been initialized
      CodeNode* cur = rootNode;
      
      //get cur to point to the last node in the list
      while (cur->next != NULL) {
        cur = cur->next;
      }
      CodeNode* newNode = new CodeNode();
      newNode->next = NULL;
      newNode->code = new byte;
      newNode->info = new char;
      for (int i = 0; i < 6; i++) {
        newNode->code[i] = _code[i];
      }
      newNode->info = _info;
      cur->next = newNode;
    }
  }
  
  numCodes++;
  return true;
}

void CodesList::printCodes() {
  CodeNode* cur = rootNode;
  int codeI = 0;
  
  while (cur != NULL) {
    byte *curCode = cur->code;
    for (int i=0; i<5; i++) {
      //if (curCode[i] < 16) Serial.print("0");
      Serial.print(curCode[i], HEX);
      //Serial.print(" ");
    }
    if (codeI < numCodes - 1) {
      Serial.print(",");
    }
    cur = cur->next;
    codeI++;
  }
  Serial.println();
}  


