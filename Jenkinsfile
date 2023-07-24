pipeline {
  agent any
  stages {
    stage('Build') {
      steps {
        echo 'Build'
      }
    }

    stage('Test') {
      agent {
        docker {
          image 'node:18.16.0-alpine'
        }

      }
      steps {
        sh 'node --version'
      }
    }

    stage('Deploy') {
      steps {
        echo 'DEPLOY'
      }
    }

  }
}